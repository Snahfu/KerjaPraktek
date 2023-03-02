<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    public $timestamps = false;

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'PIC');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'events_id', 'products_id')
        ->withPivot(['jumlah']);
    }

    public function divisis(){
        return $this->belongsToMany(Divisi::class, 'events_id', 'divisi_id');
    }
}
