<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tagihan";

    protected $fillable = [
        'id', 'invoices_id','tanggal_input', 'nominal','status','bukti_pembayaran'
    ];
}
