<?php

namespace App\Http\Controllers\Seller\Laporan;

use App\Pesanan;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index(){
        $data_pesanan = Pesanan::all();
        $detail_pesanan = PesananDetail::all();

        return view('penjual.laporan.index',compact('data_pesanan','detail_pesanan'));
    }
}
