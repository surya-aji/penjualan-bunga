<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    public function produk(){
        return $this->hasOne(KategoriBunga::class,"id");
    }
    public function pesanan(){
        return $this->hasMany(PesananDetail::class,"barang_id");
    }
    
}
