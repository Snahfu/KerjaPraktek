<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiEvent extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "events_has_divisi";

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
