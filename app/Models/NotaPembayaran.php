<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaPembayaran extends Model
{
    use HasFactory;

    protected $table = 'nota_pembayaran';
    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'kode_notapembayaran', 'kode_notapembayaran');
    }
    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class, 'kode_resepobat', 'kode_resep_obat');
    }
    public function suratRujukan()
    {
        return $this->belongsTo(SuratRujukan::class, 'kode_rujukan', 'kode_rujukan');
    }
}
