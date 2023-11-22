<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "divisi";

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }
    
    public function divisievent()
    {
        return $this->hasMany(DivisiEvent::class, 'divisi_id');
    }
}
