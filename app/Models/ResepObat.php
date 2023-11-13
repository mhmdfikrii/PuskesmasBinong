<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'resep_obat';
    protected $primarykey = 'kode_resep_obat';
    protected $keyType = 'string';

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'kode_rekamedis', 'kode_rekammedis');
    }

    public function notaPembayaran()
    {
        return $this->hasOne(NotaPembayaran::class, 'kode_resepobat', 'kode_resep_obat');
    }

    public function p_resepobat()
    {
        return $this->hasMany(P_Resepobat::class, 'kode_resep_obat', 'kode_resep_obat');
    }
}
