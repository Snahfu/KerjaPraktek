<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBarangHasEvent extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_barang_has_events";
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'item_barang_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    protected $fillable = [
        'id',
        'events_id',
        'item_barang_id',
        'qty',
        'status_in',
        'status_out',
    ];
}
