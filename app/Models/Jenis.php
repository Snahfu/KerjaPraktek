<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "jenis_barang";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_barang_idkategori');
    }
    public function eventjenis()
    {
        return $this->hasMany(EventJenis::class, 'jenis_barang_idjenis_barang');
    }
}
