<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDamage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_damage";
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'item_barang_id');
    }

    public function userReporter()
    {
        return $this->belongsTo(Karyawan::class, 'user_reporter');
    }

    public function userServicer()
    {
        return $this->belongsTo(Karyawan::class, 'user_servicer');
    }
}
