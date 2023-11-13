<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'rekam_medis';
    protected $primaryKey = 'kode_rekammedis';
    protected $keyType = 'string';

    public function dataAntrian()
    {
        return $this->hasOne(Antrian::class, 'kode_antrian', 'antrian');
    }

    public function getRouteKeyName()
    {
        return 'kode';
    }

    public function suratRujukan()
    {
        return $this->hasOne(SuratRujukan::class, 'kode_rekammedis', 'kode_rekammedis');
    }

    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class, 'kode_rekammedis', 'kode_rekamedis');
    }

    public function dataDokter()
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter');
    }
}
