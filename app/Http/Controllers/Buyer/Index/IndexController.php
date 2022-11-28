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

    public function cariProduk(Request $request){
        $cari = $request->cari;
 
    		// mengambil data dari table produk sesuai pencarian data
        $produk = DB::table('data_produks')
		->where('nama_produk','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data produk ke view index
            return view('pembeli.kategori.index',compact('produk'));
    }
    public function cariKategori(Request $request){
        $cari = $request->cari;
 
    		// mengambil data dari table produk sesuai pencarian data
        $kategori = DB::table('kategori_bungas')
		->where('jenis_kategori','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data produk ke view index
            return view('pembeli.layout.dashboard',compact('kategori'));
    }
}
