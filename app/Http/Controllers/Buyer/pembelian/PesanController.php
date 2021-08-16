<?php

namespace App\Http\Controllers\Buyer\pembelian;

use App\Pesanan;
use App\DataProduk;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            $detail_pesanan->jumlah_harga = $barang->harga_jual * $request->jumlah; // mendapatakan total harga perpesanan
            $detail_pesanan->save();
        }else{ // maka cukup lakukan update only
            $detail_pesanan = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$pesan_baru->id)->first();
            $detail_pesanan->jumlah = $detail_pesanan->jumlah + $request->jumlah; //lakukan penjumlahan dengan jumlah pemesanan detail yang lama
            //harga baru pesanan detail sekarang
            $harga_pesanan_detail_baru = $barang->harga_jual * $request->jumlah;
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

        //Ambil Data Keranjang
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

        if(!empty($pesanan)){
            $detail_pesanan =  PesananDetail::where('pesanan_id',$pesanan->id)->get();
            return view('pembeli.keranjang.index',compact('detail_pesanan','pesanan'));
        }else{
            return view('pembeli.keranjang.index',compact('pesanan'));
        }
       
        
        
    }

    public function hapusKeranjang($id){
        $delete = PesananDetail::findOrFail($id);
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

        $pesanan->total_pembayaran = $pesanan->total_pembayaran - $delete->jumlah_harga;// mengurangi jumlah total dari hapus kernjang
        $pesanan->update();

        $delete->delete();
        return back();
    }


}
