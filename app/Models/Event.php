<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "events";

    public function customer()
    {
        return $this->belongsTo(Event::class, 'customers_id');
    }
    public function divisievent()
    {
        return $this->hasMany(DivisiEvent::class, 'events_id');
    }
    public function eventjenis()
    {
        return $this->hasMany(EventJenis::class, 'events_id');
    }

    protected $fillable = [
        'id', 'PIC', 'customers_id', 'nama', 'status', 'lokasi', 'jabatan_client', 'waktu_loading','waktu_loading_out','jam_mulai_acara','jam_selesai_acara'
    ];
}
