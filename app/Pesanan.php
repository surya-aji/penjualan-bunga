<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public function pesan()
    {
        return $this->belongsTo(UserDetail::class, 'user_id','user_id');
    }
    public function detail()
    {
        return $this->hasMany(PesananDetail::class, 'id','pesanan_id');
    }
}
