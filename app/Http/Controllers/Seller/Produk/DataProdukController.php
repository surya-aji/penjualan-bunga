<?php

namespace App\Http\Controllers\Seller\Produk;

use App\DataProduk;
use App\KategoriBunga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DataProduk::all();
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
        $produk = new DataProduk;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga_awal = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;
        $produk->berat = $request->berat;
        $produk->kategori_id = $request->kategori;
        $produk->tanggal_pembelian = $request->tanggal_beli;
        
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
        $produk = DataProduk::findorfail($id);
        $kategori = KategoriBunga::all();

        // $satuanKerja = Satuankerja::all();

        return view('penjual.produk.edit',[
            'produk'=> $produk,
            'kategori' => $kategori
        ]);
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
        $update = DataProduk::findorfail($id);
        $update->nama_produk = $request->nama_produk_edit;
        $update->harga_awal = $request->harga_beli_edit;
        $update->harga_jual = $request->harga_jual_edit;
        $update->stok = $request->stok_edit;
        $update->berat = $request->berat_edit;
        $update->kategori_id = $request->kategori_edit;

        $update->update();
        return redirect('/seller/produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DataProduk::findOrFail($id);

        $file = public_path('/gambar-produk/').$delete->gambar;
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
