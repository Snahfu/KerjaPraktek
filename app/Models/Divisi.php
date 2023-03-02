<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    public $timestamps = false;

    public function events()
    {
        return $this->belongsToMany(Event::class, 'divisi_id', 'events_id');
    }
}
