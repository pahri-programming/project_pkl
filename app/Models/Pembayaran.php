<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public $fillable=['user_id','jumlah','tanggal'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
