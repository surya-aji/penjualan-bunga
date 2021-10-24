<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSuplier extends Model
{
    public function supp(){
        return $this->belongsTo(DataProduk::class,"supplier", "id",);
    }
}
