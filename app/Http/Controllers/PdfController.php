<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    //

    public function pdfPage()
    {
        $data = [
            'namaClient' => 'Christian Yaska'
        ];
        $pdf = PDF::loadView('pdf', $data);
        return $pdf->stream('surat.pdf');
    }
}
