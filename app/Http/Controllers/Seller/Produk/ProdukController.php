<?php

namespace App\Http\Controllers\Seller\Produk;

use App\ProdukDetail;
use App\KategoriBunga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = ProdukDetail::all();
        $kategori = KategoriBunga::all();
        return view('penjual.produk.index',compact('produk','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new ProdukDetail;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga_awal = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;
        $produk->kategori_id = $request->kategori;
        $produk->tanggal_pembelian = $request->tanggal_pembelian;
        
        if ($request->hasFile('gambar_produk')) {
            $nm = $request->gambar_produk;
            $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
            $produk->gambar = $namaFile;
            $nm->move(public_path() . '/gambar-produk', $namaFile);
        }else{
            $produk->gambar = 'default.png';
        }
        $produk->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
