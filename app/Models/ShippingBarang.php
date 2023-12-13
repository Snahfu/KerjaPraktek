<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingBarang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_barang_has_item_shipping";
    protected $guarded = [];

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'item_shipping_id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'item_barang_id');
    }

}
