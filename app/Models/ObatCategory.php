<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'obat_categories';
    public function obat()
    {
        return $this->hasMany(Obat::class, 'kategori_obat', 'kode_obat');
    }
}
