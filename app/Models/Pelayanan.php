<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pelayanan';

    public function p_pelayanan()
    {
        return $this->belongsTo(P_Pelayanan::class, 'id', 'pelayanan_id');
    }
}
