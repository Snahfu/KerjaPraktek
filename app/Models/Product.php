<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function events()
    {
        return $this->belongsToMany(Event::class, 'order_details', 'products_id', 'events_id')
            ->withPivot(['jumlah']);
    }
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'products_has_package', 'products_id', 'package_id');
    }
}
