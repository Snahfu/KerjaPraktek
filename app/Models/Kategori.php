<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "kategori_barang";

    public function jenises()
    {
        return $this->hasMany(Jenis::class, 'kategori_barang_idkategori');
    }
}
