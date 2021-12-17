<?php

namespace App\Http\Controllers\Seller\Penjualan;

use App\Pesanan;
use App\PesananDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function index(){
        $data_pesanan = Pesanan::all();
        $detail_pesanan = PesananDetail::all();
        

        return view('penjual.stok.index',compact('data_pesanan','detail_pesanan'));
    }

    public function cetakResi(Request $request, $id){
        $data_pesanan = Pesanan::findOrFail($id);

        $data_pesanan->resi = $request->resi;
        $data_pesanan->status_pengiriman = 1;
        $data_pesanan->update();
        // dd($data_pesanan);
        return redirect()->back();
    }

    public function validasi(Request $request, $id){
        $data_pesanan = Pesanan::findOrFail($id);
        $data_pesanan->status_pengiriman = 1;
        // dd($data_pesanan);
        $data_pesanan->update();
        return back();


    }
}
