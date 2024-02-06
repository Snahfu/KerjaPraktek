<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            padding: 7px;
            text-align: center;
        }

        td {
            padding: 7px;
        }

        th#no {
            width: 5%;
        }

        th#subject {
            width: 50%;
        }

        .header {
            font-weight: bold;
            background: #9abcff;
        }

        .bold {
            font-weight: bold;
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            width: 50%;
            margin: auto;
        }

        .centered{
            text-align: center;
        }

        .backgroundonly{
            background: #9abcff;
        }

        p, pre {
            font-family: 'Times New Roman'; 
            font-size: 16px;
        }
    </style>
</head>

<body>
    <pre>
Kepada Yth. 
{{ $data['sapaanClient'] }} {{ $data['namaClient'] }}
{{ $data['jabatanClient'] }}, {{ $data['lembagaClient'] }}
    
No. Invoice                 : {{ $data['idInvoice'] }}
Tanggal                       : {{ $data['tanggal_acara'] }}
Nama Acara                : {{ $data['namaEvent'] }}
Lokasi                         : {{ $data['lokasi'] }}
Tanggal Jatuh Tempo  : {{ $data['jatuhtempo'] }}
    </pre>
    <table>
        <thead>
            <tr>
                <th class="header" id="no">No</th>
                <th class="header" id="subject">Subject</th>
                <th class="header">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['array_kategori'] as $key => $barang)
                @if (!empty($barang))
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="bold">{{ $key }}</td>
                        <td class="bold">{{ $data['kategori_map'][$key] }}</td>
                        <td class="bold centered">Rp{{ number_format($data['subtotal_map'][$key] / $data['lamaEvent'], 0, ',', ',') }}
                        </td>
                    </tr>
                    @for ($j = 0; $j < count($data['array_kategori'][$key]); $j++)
                        <tr>
                            <td></td>
                            <td class="bold">{{ $data['array_kategori'][$key][$j]->nama }}</td>
                            <td></td>
                        </tr>
                    @endfor
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @if ($data['lamaEvent'] > 1)
                <tr>
                    <td class="backgroundonly"></td>
                    <td class="backgroundonly centered"> Harga Sewa / Hari </td>
                    <td class="backgroundonly centered">Rp{{ number_format($data['grandtotal'] / $data['lamaEvent'], 0, ',', ',') }}
                    </td>
                </tr>
            @endif
            <tr>
                <td class="header"></td>
                <td class="header centered"> Total Sewa {{ ($data['lamaEvent'] > 1) ? ($data['lamaEvent']." Hari" ) : "" }} </td>
                <td class="header centered">Rp{{ number_format($data['grandtotal'], 0, ',', ',') }}</td>
            </tr>
            @if ( $data['tagihan_data']->status == "Belum DP" )
                {{-- BELUM BAYAR SAMA SEKALI --}}
                <tr>
                    <td class="header"></td>
                    <td class="header centered"> Pembayaran DP 50% </td>
                    <td class="header centered">Rp{{ number_format(($data['grandtotal']/2), 0, ',', ',') }}</td>
                </tr>
            @else
                {{-- SUDAH BAYAR --}}
                <tr>
                    <td class="header"></td>
                    <td class="header centered"> Nominal sudah terbayarkan </td>
                    <td class="header centered">Rp{{ number_format($data['total_bayar'], 0, ',', ',') }}</td>
                </tr>
                <tr>
                    <td class="header"></td>
                    <td class="header centered"> Nominal tertagih </td>
                    <td class="header centered">Rp{{ number_format(($data['grandtotal']-$data['total_bayar']) , 0, ',', ',') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <p>Cara Pembayaran:</p>
    <p> Ditujukan pada rekening BCA nomor rekening: 123456789 </p>
    <p> Atas nama : Mr Rental Alat </p>
    <br>
    <table style="border: none" cellpadding="0" cellspacing="0" width="100%">
        <tr style="border: none">
            <td style="border: none; text-align:center" width="50%" valign="top">
                <p>Terima Kasih atas kerjasamanya.</p>
                <br>
                <br>
                <br>
                <br>
                <p>Mr Rental Alat</p>
            </td>
            <td style="border: none; text-align:center" width="50%" valign="top">

            </td>
        </tr>
    </table>
    </div>
</body>

</html>
