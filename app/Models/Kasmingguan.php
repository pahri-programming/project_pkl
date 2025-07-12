<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasmingguan extends Model
{
    protected $table = 'kas_mingguans'; 

    public $fillable = [
        'user_id', 'status', 'minggu_ke', 'bulan', 'jumlah', 'tanggal_bayar',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

