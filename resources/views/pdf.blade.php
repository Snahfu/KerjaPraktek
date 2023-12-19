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
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            width: 50%;
            margin: auto;
        }
    </style>
</head>

<body>
    <p>Kepada Yth</p>
    <p>{{ $data['sapaanClient'] }} {{ $data['namaClient'] }}</p>
    <p> {{ $data['jabatanClient'] }}, {{ $data['lembagaClient'] }}</p>
    <p>Ditempat.</p>
    <p></p>
    <p>Surabaya, {{ $data['tanggalNow'] }}</p>
    <p>Dengan Hormat, Untuk mendukung acara {{ $data['namaEvent'] }}, yang akan diselenggarakan selama
        {{ $data['lamaEvent'] }}
        hari pada {{ $data['pelaksanaan'] }}. Maka kami bermaksud mengajukan pemakaian
        {{ implode(', ', $data['kategoriSewa']) }} dengan
        rincian sebagai berikut:</p>
    <table>
        <thead>
            <tr>
                <th id="no">No</th>
                <th id="subject">Subject</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="header">1</td>
                <td class="header">Sound System</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td class="header">- Sound System 8000 watt</td>
                <td>1</td>
                <td>Set</td>
                <td>Rp 19,150,000</td>
            </tr>
            <tr>
                <td></td>
                <td>- Bose F1</td>
                <td>1</td>
                <td>Set</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>- Bose L1</td>
                <td>1</td>
                <td>Set</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br>
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
                <p>Nama</p>
            </td>
        </tr>
    </table>
    </div>
</body>

</html>
