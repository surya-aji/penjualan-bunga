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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/not-authorized', function () {
    return view('401');
});




Route::middleware(['auth'])->group(function () {
    
    // ====================Buyer
    Route::group(['prefix' => 'buyer','middleware' => 'buyer'],function(){
        Route::get('/dashboard', function () {
            return view('pembeli.layout.dashboard');
        });

        Route::get('/keranjang', function () {
            return view('pembeli.keranjang.index');
        });
    });


    // =====================Seller

    Route::group(['prefix' => 'seller','middleware' => 'seller'],function(){
        
        Route::get('/dashboard', function () {
            return view('penjual.layout.dashboard');
        });
        
        Route::get('/stok', function () {
            return view('penjual.stok.index');
        });

        Route::get('/pembelian-produk', function () {
            return view('penjual.produk.index');
        });
        Route::get('/data-supplier', function () {
            return view('penjual.supplier.index');
        });

        Route::get('/laporan', function () {
            return view('penjual.laporan.index');
        });

});





   
    
});