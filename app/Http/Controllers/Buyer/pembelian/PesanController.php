<?php

namespace App\Http\Controllers\Buyer\pembelian;

use App\Kota;
use App\Kurir;
use App\Pesanan;
use App\Provinsi;
use App\DataProduk;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class PesanController extends Controller
{
    public function index($id){
        $barang =  DataProduk::where('id',$id)->first();
        return view('pembeli.kategori.pesan',compact('barang'));
    }

    
    public function pesan(Request $request,$id){
        $barang =  DataProduk::where('id',$id)->first();

        // Validasi Stok
        if($request->jumlah > $barang->stok){
            return redirect('buyer/pesan/'.$id)->with('stok','Sesuaikan dengan stok yang tersedia');
        }


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

        //Ambil Data Keranjang
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();


        if(!empty($pesanan)){
            $detail_pesanan =  PesananDetail::where('pesanan_id',$pesanan->id)->get();
            return view('pembeli.keranjang.index',compact('detail_pesanan','pesanan','kurir','provinsi','kota'));
        }else{
            return view('pembeli.keranjang.index',compact('pesanan','kurir','provinsi','kota'));
        }
       
        
        
    }

    public function check_ongkir(Request $request)
    {
        // Ambil Data
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();
        $detail_pesanan = PesananDetail::where('pesanan_id',$pesanan->id)->sum('jumlah_berat');
        $detail = PesananDetail::where('pesanan_id',$pesanan->id)->first();
        $barang =  DataProduk::where('id',$detail->barang_id)->first();

        


        

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 42,     // ID kota/kabupaten banyuwangi
            'destination'   => $request->kota_tujuan,      // ID kota/kabupaten tujuan
            'weight'        => $detail_pesanan,    // berat barang dalam gram
            'courier'       => $request->kurir    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $biaya = $cost[0]['costs'][0]['cost'][0]; // ambil data biaya ongkir
        $kurir = $cost[0]['name']; //ambil data nama kurir
        $layanan = $cost[0]['costs'][0]['service']; // ambil data layanan yang dipakai
        
        // $pesanan->resi = mt_rand(100000, 999999);
        $pesanan->status = 1;
        $pesanan->ongkos_kirim = $biaya['value'];
        $pesanan->kurir =  $kurir;
        $pesanan->layanan =  $layanan;
        if(!empty($request->detail_alamat)){
            $pesanan->alamat_lengkap = $request->detail_alamat;
        }else{
            $pesanan->alamat_lengkap = Auth::user()->detail->alamat_lengkap;
        }
        $pesanan->update();
        $barang->stok = $barang->stok - $detail->jumlah ; // pengurangan stok ketika sudah check out
        $barang->update();


        return redirect('buyer/pembelian');


        // dd($layanan);
        // dd($biaya['value']);
        // dd($detail_pesanan);
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

        return view('pembeli.pembelian.index',compact('pesanan','detail_pesanan'));
    }


}
