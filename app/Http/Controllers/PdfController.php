<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PdfController extends Controller
{
    //

    public function pdfPage()
    {
        $tanggalMulai = Carbon::parse('2023-11-20 14:13:56');
        $tanggalSelesai = Carbon::parse('2023-11-20 20:13:56');

        $perbedaanJam = $tanggalSelesai->diffInHours($tanggalMulai);
        $nilaiPerbedaan = 1;
        if ($tanggalMulai->isSameDay($tanggalSelesai) && $perbedaanJam < 24) {
            $nilaiPerbedaan = 1;
        } else {
            $nilaiPerbedaan = $tanggalSelesai->diffInDays($tanggalMulai);
        }
        $tanggalMulaiDiformat = $tanggalMulai->format('l, d F Y');
        $tanggalSekarang = Date::now();
        $tanggalDiformat = $tanggalSekarang->format('d F Y');

        $data = [
            'namaClient' => 'Christian Yaska',
            'sapaanClient' => 'Bapak',
            'jabatanClient' => 'Koordinator Acara',
            'lembagaClient' => 'UBAYA',
            'tanggalNow' => $tanggalDiformat,
            'namaEvent' => 'JAFEST',
            'lamaEvent' => $nilaiPerbedaan,
            'pelaksanaan' => $tanggalMulaiDiformat,
            'kategoriSewa' => ["Sound System", "Lighting", "FOH"],
            'catatanEvent' => 'Hai',
            'noHP_pic' => '08872143452',
            'nama_pic' => 'Alvin Sales',
        ];
        $pdf = PDF::loadView('pdf', $data);
        return $pdf->stream('surat.pdf');
        // return view('pdf', compact('data'));
    }
}
