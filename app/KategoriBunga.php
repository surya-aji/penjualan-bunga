<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBunga extends Model
{

    protected $fillable = ['jenis_kategori', 'gambar'];
    public function bunga(){
        return $this->belongsTo(DataProduk::class,'kategori_id');
    }
    
}
