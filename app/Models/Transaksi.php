<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'transaksi';

    public function notaPembayaran()
    {
        return $this->belongsTo(NotaPembayaran::class, 'kode_notapembayaran', 'kode_notapembayaran');
    }
}
