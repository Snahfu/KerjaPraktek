<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_barang";
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function itemDamage()
    {
        return $this->hasMany(ItemDamage::class, 'item_barang_id');
    }

    public function shippingBarang()
    {
        return $this->hasMany(ShippingBarang::class, 'item_barang_id');
    }
}
