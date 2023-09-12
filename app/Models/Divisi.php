<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_divsi', 'divisi_id', 'events_id');
    }
}
