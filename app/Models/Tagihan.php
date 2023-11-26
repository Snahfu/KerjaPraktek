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
        'id', 'events_id', 'termin_number', 'tanggal_input', 'tanggal_tagihan', 'nominal','status','bukti_pembayaran'
    ];
}
