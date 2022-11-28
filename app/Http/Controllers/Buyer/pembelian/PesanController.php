<?php

namespace App\Http\Controllers\Buyer\pembelian;

use App\Kota;
use App\Kurir;
use App\Pesanan;
use App\Provinsi;
use App\DataProduk;
use App\PesananDetail;
use App\User;
use App\user_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Order;
use App\ProdukDetail;
use App\UserDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Transaction;
use Midtrans\ApiRequestor;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class PesanController extends Controller
{
    
    private $snapToken;
    private $pesanan;
    private $detail_pesanan;
    private $user_detail;

    public function index($id){
        $barang =  DataProduk::where('id',$id)->first();
        return view('pembeli.kategori.pesan',compact('barang'));
    }

    
    public function pesan(Request $request,$id){
        $barang =  DataProduk::where('id',$id)->first();

        // Validasi Stok
        if($request->jumlah > $barang->stok){
            Alert::error('Pemesanan gagal', 'Sesuaikan Dengan stok yang ada');
            return redirect('buyer/pesan/'.$id)->with('stok', 'Sesuaikan Dengan stok yang ada');
        }
        Alert::success('Berhasil', '');


        // Validasi jika Pemesanan Belum Dibuat maka lakukan ini
        $cek_pemesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        if(empty( $cek_pemesanan)){
            
        // simpan data ke tabel pesanan
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = Carbon::now();
            $pesanan->status = 0;
            $pesanan->barang_id = $barang->id;
            $pesanan->total_pembayaran = 0;
            $pesanan->save();
        }



        
 
        $pesan_baru = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first(); //mendaptakan id pesanan

        // cek untuk pemesanan barang yang sama
        $cek_detail_pesanan = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$pesan_baru->id)->first();
        if(empty($cek_detail_pesanan)){ // jika belum terdapat pemesanan barang yang sama
            // simpan ke pesanan detail    
            $detail_pesanan = new PesananDetail;
            $detail_pesanan->barang_id = $barang->id;
            $detail_pesanan->pesanan_id =  $pesan_baru->id;
            $detail_pesanan->jumlah = $request->jumlah; //hasil jumlah inputan
            $detail_pesanan->jumlah_berat = $barang->berat * $request->jumlah;
            $detail_pesanan->jumlah_harga = $barang->harga_jual * $request->jumlah; // mendapatakan total harga perpesanan
            $detail_pesanan->save();
        }else{ // maka cukup lakukan update only
            $detail_pesanan = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$pesan_baru->id)->first();
            $detail_pesanan->jumlah = $detail_pesanan->jumlah + $request->jumlah; //lakukan penjumlahan dengan jumlah pemesanan detail yang lama
            //harga baru pesanan detail sekarang
            $jumlah_berat_baru = $barang->berat * $request->jumlah; //tambah jumlah untuk berat
            $harga_pesanan_detail_baru = $barang->harga_jual * $request->jumlah;

            $detail_pesanan->jumlah_berat = $barang->berat + $jumlah_berat_baru;
            $detail_pesanan->jumlah_harga = $barang->harga_jual +  $harga_pesanan_detail_baru; // mendapatakan total harga pesanan detail baru
            $detail_pesanan->update();
        }
       
        // Penjumlahan Keseluruhan Detail Pesanan kemudian simpan ke tabel pesanan
        $total_keseluaran_pesanan_detail = PesananDetail::where('pesanan_id',$pesan_baru->id)->sum('jumlah_harga');
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first(); 
        $pesanan->total_pembayaran = $total_keseluaran_pesanan_detail ;// $pesanan->total_pembayaran + sum('');
        $pesanan->update();

        return redirect('buyer/keranjang');

    }

    public function keranjang(){

        // RajaOngkirKode
        $kurir = Kurir::pluck('nama_kurir','kode');
        $provinsi = Provinsi::pluck('nama_provinsi','provinsi_id');
        $kota = Kota::pluck('nama_kota','kota_id');
        $data_kota = Kota::all();

        //Ambil Data Keranjang
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        $alamat1 = UserDetail::where('user_id',Auth::user()->id)->join('kotas','user_details.kota_satu','=','kotas.kota_id')->first();
        $alamat2 = UserDetail::where('user_id',Auth::user()->id)->join('kotas','user_details.kota_dua','=','kotas.kota_id')->first();
        $alamat3 = UserDetail::where('user_id',Auth::user()->id)->join('kotas','user_details.kota_tiga','=','kotas.kota_id')->first();


        
        if(!empty($pesanan)){
            $detail_pesanan =  PesananDetail::where('pesanan_id',$pesanan->id)->get();
            return view('pembeli.keranjang.index',compact('detail_pesanan','pesanan','kurir','provinsi','kota','alamat1','alamat2','alamat3','data_kota'));
        }else{
            return view('pembeli.keranjang.index',compact('pesanan','kurir','provinsi','kota','alamat1','alamat2','alamat3','data_kota'));
        }
       
        
        
    }

    public function check_ongkir(Request $request)
    { 
         
        // Ambil Data
        $tambah_alamat= UserDetail::where('user_id',Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        $detail_pesanan = PesananDetail::where('pesanan_id',$pesanan->id)->sum('jumlah_berat');
        $detail = PesananDetail::where('pesanan_id',$pesanan->id)->first();
        $barang =  DataProduk::where('id',$detail->barang_id)->first();
        
        $test =  PesananDetail::where('pesanan_id',$pesanan->id)->get();

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 42,     // ID kota/kabupaten banyuwangi
            'destination'   => $request->kota_tujuan,      // ID kota/kabupaten tujuan
            'weight'        => $detail_pesanan,    // berat barang dalam gram
            'courier'       => $request->kurir    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        

        // dd($cost);
        
        $biaya = $cost[0]['costs'][0]['cost'][0]; // ambil data biaya ongkir
        $kurir = $cost[0]['name']; //ambil data nama kurir
        $layanan = $cost[0]['costs'][0]['service']; // ambil data layanan yang dipakai
        
      
        // alert()->html('Konfirmasi Pesanan','<div class = text-left>'.
        //                 'Total Harga Pesanan : '.'Rp.' . $pesanan->total_pembayaran .'<br/>' . 
        //                 'Ongkir : '.'Rp.' . $cek_ongkir .'<br/>' .
        //                 'Layanan yang Digunakan : ' . $layanan . '<br/>' . '<hr>'.'</div>' )
        //     ->focusConfirm(true)
        //     ->showConfirmButton('Confirm', '#3085d6')
        //     ->showCancelButton($btnText = 'Cancel', $btnColor = '#aaa');

        
        $pesanan->status = 1;
        $pesanan->ongkos_kirim = $biaya['value'];
        
        if($tambah_alamat->alamat_pertama != null){
            if($tambah_alamat->alamat_kedua != null){
                if($tambah_alamat->alamat_ketiga != null){
                }else{
                    $tambah_alamat->alamat_ketiga = $request->detail_alamat;
                    $tambah_alamat->kota_tiga = $request->kota_tujuan;
                }
            }else{
                $tambah_alamat->alamat_kedua = $request->detail_alamat;
                $tambah_alamat->kota_dua = $request->kota_tujuan;
            }
        }else{
            $tambah_alamat->alamat_pertama = $request->detail_alamat;
            $tambah_alamat->kota_satu = $request->kota_tujuan;
        }
        
        $pesanan->alamat_lengkap = $request->detail_alamat;

        $pesanan->kurir = $kurir;
        $pesanan->layanan = $layanan;
        

        $barang->stok = $barang->stok - $detail->jumlah ; // pengurangan stok ketika sudah check out
        
        $tambah_alamat->update();
        $detail->update();
        $pesanan->update();
        $barang->update();
       
        return redirect('buyer/pembelian');

    }
    
    public function hapusKeranjang($id){
        $delete = PesananDetail::findOrFail($id);
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

        $pesanan->total_pembayaran = $pesanan->total_pembayaran - $delete->jumlah_harga;// mengurangi jumlah total dari hapus kernjang
        $pesanan->update();

        $delete->delete();
        return back();
    }

    public function pembelian(){
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',1)->get();

        $getdataPesan = Pesanan::where('user_id',Auth::user()->id)->where('status',1)->first();

        $detail_pesanan = PesananDetail::all();

        // $detail_pesanan = PesananDetail::where('pesanan_id',$getdataPesan->id)->get();

        // $st = $this->snapToken;




        // return view('pembeli.pembelian.index',compact('pesanan','detail_pesanan'));

        // $detail_pesanan = PesananDetail::where('pesanan_id',$getdataPesan->id)->get();
        // $detail_barang = DataProduk::all();


        return view('pembeli.pembelian.index',compact('pesanan','detail_pesanan'));

    }

    public function pembelianDetail($id)
    {
        // midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'Mid-server-4apdLLraTf_v44fK9GBNptEK';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;  
        
        

        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',1)->where('id',$id)->get();
        $detail_produk = PesananDetail::where('barang_id', 2)->get();
        $barang[''] = DataProduk::find($id);
        
        $getdataPesan = Pesanan::where('user_id',Auth::user()->id)->where('status',1)->where('id',$id)->first();
        $detail_pesanan = PesananDetail::where('pesanan_id',$getdataPesan->id)->get();
        
        $this->user_detail = UserDetail::find(Auth::user()->id);
        $ud = $this->user_detail;        
        if (!empty($getdataPesan)) {
            if ($getdataPesan->status_pembayaran == 0) {
                try {
                    $params = array(
                        'transaction_details' => array(
                            // 'order_id' => $getdataPesan->resi,
                            'order_id' => $getdataPesan->id,
                            'gross_amount' => $getdataPesan->total_pembayaran + $getdataPesan->ongkos_kirim,
                        ),
                        'customer_details' => array(
                            'first_name' => '[Saudara/Saudari]',
                            'last_name' => Auth::user()->name,
                            'email' => Auth::user()->email,
                            'phone' => $this->user_detail->no_telp,
                        ),
                    );
                    $this->snapToken = \Midtrans\Snap::getSnapToken($params);                
                    $st = $this->snapToken;
                    $status = 0;
                } catch (Throwable $e) {
                    return redirect('buyer/pembelian');
                }
                
            }elseif($getdataPesan->status_pembayaran == 1){
                $st = $this->snapToken;
                $status = \Midtrans\Transaction::status($getdataPesan->resi);
                $status = json_decode(json_encode($status), true);
                // dd($status);
                if($status['transaction_status'] == 'settlement'){
                    $this->gross_amount = $status['gross_amount'];
                    $this->transaction_status = $status['transaction_status'];
                    $transaction_time = $status['transaction_time'];
                    $this->dead_line = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                }else{
                    $this->gross_amount = $status['gross_amount'];
                    $this->transaction_status = $status['transaction_status'];
                    $transaction_time = $status['transaction_time'];
                    $this->dead_line = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                }
            }
        }
        return view('pembeli.pembelian.detail',compact('pesanan','detail_pesanan','st','ud','getdataPesan', 'status'));
    }

    public function validasi(Request $request, $id){
        $data_pesanan = Pesanan::findOrFail($id);
        $data_pesanan->status_pengiriman = 2;
        // dd($data_pesanan);
        $data_pesanan->update();
        return back();


    }

    public function pembelianFinish()
    {
        
    }   
}
