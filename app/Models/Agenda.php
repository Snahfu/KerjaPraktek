<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "agenda";

    protected $fillable = [
        'judul', 'deskripsi', 'mulai', 'selesai', 'id', 'warna'
    ];
}
