<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJenis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "jenis_barang_has_events";

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_barang_idjenis_barang');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    protected $fillable = [
        'jenis_barang_idjenis_barang', 'events_id', 'qty', 'harga_barang', 'subtotal'
    ];
}
