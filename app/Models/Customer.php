<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "customers";

    public function events()
    {
        return $this->hasMany(Event::class, 'customers_id');
    }

    protected $fillable = [
        'nama_pelanggan', 'nohp_pelanggan', 'alamat_pelanggan', 'id','sapaan'
    ];
}
