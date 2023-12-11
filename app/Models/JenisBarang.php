<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "jenis_barang";
    protected $guarded = [];

    public function publikasis(){
        return $this->hasMany(Barang::class,'jenis_barang_id');
    }
}
