<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'antrian';
    public $incrementing = false;
    protected $primaryKey = 'kode_antrian';
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'kode_antrian';
    }

    public function poli()
    {
        return $this->hasOne(Poli::class, "kode_poli", "kode_poli");
    }

    public function User()
    {
        return $this->belongsTo(User::class, "NIK", "NIK");
    }

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'kode_antrian', 'antrian');
    }
}
