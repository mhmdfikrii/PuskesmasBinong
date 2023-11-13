<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratRujukan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'surat_rujukan';
    protected $primaryKey = 'kode_rujukan';
    protected $keyType = 'string';

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'kode_rekammedis', 'kode_rekammedis');
    }

    public function notaPembayaran()
    {
        return $this->hasOne(NotaPembayaran::class, 'kode_rujukan', 'kode_rujukan');
    }
}
