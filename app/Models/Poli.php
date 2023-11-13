<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'poli';

    public $incrementing = false;
    protected $primaryKey = 'kode_poli';

    public function getRouteKeyName()
    {
        return 'kode';
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class, "kode_poli", "kode_poli");
    }

    public function ruangan()
    {
        return $this->hasOne(Ruangan::class, 'kode_ruangan', 'kode');
    }

    public function dataDokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter');
    }
}
