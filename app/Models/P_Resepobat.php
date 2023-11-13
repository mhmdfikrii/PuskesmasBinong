<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P_Resepobat extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'p_resep_obat';

    public function resepObat()
    {
        return $this->hasOne(ResepObat::class, 'kode_resep_obat', 'kode_resep_obat');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'kode_obat', 'kode_obat');
    }
}
