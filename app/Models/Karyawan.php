<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    public $timestamps = false;

    public function events()
    {
        return $this->hasMany(Event::class, 'PIC');
    }
}
