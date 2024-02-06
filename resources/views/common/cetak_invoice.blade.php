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

        .khusus{
            background: #9abcff;
            text-align: center;
        }

        .tengah{
            text-align: center;
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            width: 50%;
            margin: auto;
        }

        p,
        pre {
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
Ditempat.</pre>
    <p>Surabaya, {{ $data['tanggalNow'] }}</p>
    <p class="bottom-gone">Dengan Hormat,</p>
    <p> Untuk mendukung acara {{ $data['namaEvent'] }}, yang akan diselenggarakan selama
        {{ $data['lamaEvent'] }}
        hari pada {{ $data['pelaksanaan'] }}. Maka kami bermaksud mengajukan pemakaian
        {{ implode(', ', $data['kategoriSewa']) }} dengan
        rincian sebagai berikut:</p>
    <table>
        <thead>
            <tr>
                <th class="header" id="no">No</th>
                <th class="header" id="subject">Subject</th>
                <th class="header">Qty</th>
                <th class="header">Harga per Qty</th>
                <th class="header">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['array_kategori'] as $key => $barang)
                @if (!empty($barang))
                    <tr>
                        <td class="bold tengah">{{ $key }}</td>
                        <td colspan="3" class="bold">{{ $data['kategori_map'][$key] }}</td>
                        <td class="bold tengah">Rp{{ number_format($data['subtotal_map'][$key] / $data['lamaEvent'], 0, ',', ',') }}
                        </td>
                    </tr>
                    @for ($j = 0; $j < count($data['array_kategori'][$key]); $j++)
                        <tr>
                            <td></td>
                            <td class="bold">{{ $data['array_kategori'][$key][$j]->nama }}</td>
                            <td class="tengah">{{ $data['array_kategori'][$key][$j]->jumlah }}</td>
                            <td class="tengah">Rp{{ number_format($data['array_kategori'][$key][$j]->harga, 0, ',', ',') }}</td>
                            <td class="tengah">Rp{{ number_format($data['array_kategori'][$key][$j]->subtotal / $data['lamaEvent'], 0, ',', ',') }}</td>
                        </tr>
                    @endfor
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @if ($data['lamaEvent'] > 1)
                <tr>
                    <td class="khusus"></td>
                    <td class="khusus" colspan="3"> Harga Sewa / Hari </td>
                    <td class="khusus">Rp{{ number_format($data['grandtotal'] / $data['lamaEvent'], 0, ',', ',') }}
                    </td>
                </tr>
            @endif
            <tr>
                <td class="khusus"></td>
                <td class="header khusus" colspan="3"> Total Sewa {{ ($data['lamaEvent'] > 1) ? ($data['lamaEvent']." Hari" ) : "" }} </td>
                <td class="header khusus">Rp{{ number_format($data['grandtotal'], 0, ',', ',') }}</td>
            </tr>
        </tbody>
    </table>
    <p>Catatan:</p>
    <p> {{ $data['catatanEvent'] }} </p>
    <br>
    <p> Demikian penawaran kami sementara, semoga acara dapat berlangsung lancar, Kami tunggu kabar baiknya, bila ada
        informasi lebih lanjut dapat menghubungi kami di no: {{ $data['noHP_pic'] }}. Atas perhatian
        {{ $data['sapaanClient'] }}
        {{ $data['namaClient'] }}, kami ucapkan terimakasih.
    </p>
    <table style="border: none" cellpadding="0" cellspacing="0" width="100%">
        <tr style="border: none">
            <td style="border: none; text-align:center" width="50%" valign="top">
                <p>Hormat kami,</p>
                <br>
                <br>
                <br>
                <br>
                <p>{{ $data['nama_pic'] }}</p>
            </td>
            <td style="border: none; text-align:center" width="50%" valign="top">
                <p>Menyetujui</p>
                <br>
                <br>
                <br>
                <br>
                <p> {{ $data['namaClient'] }}</p>
            </td>
        </tr>
    </table>
    </div>
</body>

</html>
