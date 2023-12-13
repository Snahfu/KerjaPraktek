<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBarang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "item_barang_has_invoices";
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'item_barang_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }
}
