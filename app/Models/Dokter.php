<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'dokter';

    public function User()
    {
        return $this->belongsTo(User::class, 'id', 'userid');
    }

    public function poli()
    {
        return $this->hasOne(Poli::class, 'dokter');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter');
    }
}
