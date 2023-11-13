<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "ruangan";
    protected $keyType = 'string';

    public $incrementing = false;
    // TODO refactor this kode Ruangan
    protected $primaryKey = 'kode';

    public function getRouteKeyName()
    {
        return 'kode';
    }

    // Model Ruangan
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'kode', 'kode_ruangan');
    }
}
