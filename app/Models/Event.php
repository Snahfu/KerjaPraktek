<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'PIC');
    }
    public function divisis()
    {
        return $this->belongsToMany(Divisi::class, 'events_has_divsi', 'events_id', 'divisi_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'events_id', 'products_id')
            ->withPivot(['jumlah']);
    }
}
