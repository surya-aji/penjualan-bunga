<?php

namespace App\Http\Controllers\Buyer\Index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $id = request()->segment(3);
        $produk = DB::table('data_produks')
        ->where('kategori_id',$id)
        ->get();
        return view('pembeli.kategori.index',compact('produk'));
    }
}
