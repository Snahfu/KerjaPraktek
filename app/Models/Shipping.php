<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_shipping";
    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'driver');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function shippingBarang()
    {
        return $this->hasMany(ShippingBarang::class, 'item_shipping_id');
    }
}
