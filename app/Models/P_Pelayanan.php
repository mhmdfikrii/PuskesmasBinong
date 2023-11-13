<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P_Pelayanan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'p_pelayanan';

    public function pelayanan()
    {
        return $this->hasOne(Pelayanan::class, 'id', 'pelayanan_id');
    }
}
