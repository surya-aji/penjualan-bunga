<?php

namespace App\Http\Controllers\Seller\Produk;

use App\KategoriBunga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriBunga::all();
        return view('penjual.kategori.index',compact('kategori'));
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
        $produk = new KategoriBunga;
        $produk->jenis_kategori = $request->jenis_kategori;
        if ($request->hasFile('gambar_kategori')) {
            $nm = $request->gambar_kategori;
            $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
            $produk->gambar = $namaFile;
            $nm->move(public_path() . '/gambar-kategori', $namaFile);
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
        $delete = KategoriBunga::findOrFail($id);

        $file = public_path('/gambar-kategori/').$delete->gambar;
        //cek jika ada gambar
        if (file_exists($file)){
            //maka delete file diforder public/img
            @unlink($file);
        }
        //delete data didatabase
        $delete->delete();
        return back();
    }
}
