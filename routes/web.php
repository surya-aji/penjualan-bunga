<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/not-authorized', function () {
    return view('401');
});




Route::middleware(['auth'])->group(function () {
    
    // ====================Buyer
    Route::group(['prefix' => 'buyer','middleware' => 'buyer'],function(){
        Route::get('/dashboard','DashboardController@index');
        Route::get('/kategori/{id}','Buyer\Index\IndexController@index')->name('halaman-kategori');
        Route::get('/kategori/produk/cari','Buyer\Index\IndexController@cariProduk')->name('cari-produk');
        Route::get('/dashboard/cari','Buyer\Index\IndexController@cariProduk')->name('cari-kategori');
        Route::get('/pesan/{id}','Buyer\pembelian\PesanController@index')->name('pesan');
        Route::post('/ambil-pesan/{id}','Buyer\pembelian\PesanController@pesan')->name('masukan-keranjang');

        Route::get('/keranjang', 'Buyer\pembelian\PesanController@keranjang');
        Route::delete('/hapus-keranjang/{id}', 'Buyer\pembelian\PesanController@hapusKeranjang')->name('hapus-keranjang');
        Route::get('/keranjang', 'Buyer\pembelian\PesanController@keranjang');
        Route::post('/keranjang', 'Buyer\pembelian\PesanController@check_ongkir')->name('check-out');
        
        // Route::get('/keranjang', 'Buyer\pembelian\PesanController@check_ongkir')->name('check-out');
        Route::get('keranjang/{id}', 'Buyer\pembelian\PesanController@getCities')->name('get-kota');
        Route::get('pembelian', 'Buyer\pembelian\PesanController@pembelian')->name('pembelian');
        Route::get('pembelian/{id}/detail', 'Buyer\pembelian\PesanController@pembelianDetail')->name('pembelianDetail');
        Route::post('pembelian/{id}/finish', 'midtransnController@beli')->name('pembelianfinish');
        Route::post('pembelian/validasi/{id}', 'Buyer\Pembelian\PesanController@validasi')->name('validasi-terima');

    });


    // =====================Seller

    Route::group(['prefix' => 'seller','middleware' => 'seller'],function(){
        
        Route::get('/dashboard', function () {
            $data_pesanan = DB::table('pesanans')->count();
            $data_supplier = DB::table('data_supliers')->count();
            $data_produk = DB::table('data_produks')->sum('stok');
            $data_customer = DB::table('users')->where('role_id',1)->count();
            return view('penjual.layout.dashboard',compact('data_pesanan','data_customer','data_produk','data_supplier'));
        });
        
        Route::get('/penjualan', 'Seller\order\OrderController@index');
        Route::get('/penjualan/{id}/detail', 'Seller\order\OrderController@detail');
        Route::patch('/penpenjualan/{id}/update', 'Seller\order\OrderController@update')->name('updateOrder');
        Route::get('/penjualan', 'Seller\Penjualan\PenjualanController@index');
        Route::post('/penjualan/resi/{id}', 'Seller\Penjualan\PenjualanController@cetakResi')->name('cetak-resi');
        Route::post('/penjualan/validasi/{id}', 'Seller\Penjualan\PenjualanController@validasi')->name('validasi-kirim');

        // Route::get('/penjualan', 'Seller\order\OrderController@index');
        // Route::get('/penjualan/{id}/detail', 'Seller\order\OrderController@detail');
        // Route::post('/penjualan/{id}/update', 'Seller\order\OrderController@update')->name('updateOrder');


        Route::resource('/produk', 'Seller\Produk\DataProdukController');
        Route::resource('/kategori', 'Seller\Produk\DataKategoriController');
        Route::resource('/data-supplier', 'Seller\Supplier\SupplierController');
        Route::get('/laporan', 'Seller\Laporan\LaporanController@index');

});





   
    
});