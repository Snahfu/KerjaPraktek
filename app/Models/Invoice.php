<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "invoices";
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function invoiceBarang(){
        return $this->hasMany(InvoiceBarang::class,'invoices_id');
    }

    protected $fillable = [
        'id',
        'events_id',
        'tanggal_buat',
        'tanggal_jatuh_tempo',
        'total_harga',
        'status',
        'catatan',
    ];
}
