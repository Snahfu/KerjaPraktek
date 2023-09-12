<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function events()
    {
        return $this->hasMany(Event::class, 'PIC');
    }
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
