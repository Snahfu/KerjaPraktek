<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJenis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_barang_has_invoices";

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    protected $fillable = [
        'jenis_barang_id', 'events_id', 'qty', 'harga_barang', 'subtotal'
    ];
}
