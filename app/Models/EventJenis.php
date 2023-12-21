<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJenis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "detail_invoice";

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }

    protected $fillable = [
        'jenis_barang_id', 'invoices_id', 'qty', 'harga_barang', 'subtotal'
    ];
}