<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_has_package', 'package_id', 'products_id');
    }
}
