<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'nama', 'alamat_lengkap',  'no_telp','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
  
}
