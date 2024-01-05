@extends('layouts.app')

@section('title')
    Data Tagihan
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Tabel Tagihan</h4>
                </div>
                <div class="card-body text-dark">
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                        id="listorder2">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Nama Acara</th>
                                <th>Tanggal Acara</th>
                                <th>Nama Client</th>
                                <th>PIC</th>
                                <th>Nominal Sudah Bayar</th>
                                <th>Nominal Sisa</th>
                                <th>Status Tagihan</th>
                                {{-- Draft, Menunggu Persetujuan, Diproses, Diterima, Event Berlangsung, Selesai, Tagihan --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp
                            @foreach ($list_invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->nama }}</td>
                                    <td>{{ $invoice->tanggal }}</td>
                                    <td>{{ $invoice->sapaan }} {{ $invoice->nama_pelanggan }}</td>
                                    <td>{{ $invoice->namaPIC }}</td>
                                    {{-- Rp{{ number_format($harus_bayar, 0, ',', ',') }} --}}
                                    <td>Rp{{ number_format($arrayTotalBayar[$counter], 0, ',',',') }}</td>
                                    <td>Rp{{ number_format($invoice->total_harga,0,',',',') }}</td>
                                    <td>{{ $invoice->status_tagihan }}</td>
                                    <td>
                                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link nav-icon-hover"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-settings"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                                                    <div class="message-body">
                                                        <a href="{{ route('tagihan.cetak', ['id' => $invoice->id]) }}"
                                                            class="d-flex align-items-center gap-2 dropdown-item">
                                                            <i class="ti ti-file-text fs-6"></i>
                                                            <p class="mb-0 fs-3">Cetak Invoice</p>
                                                        </a>
                                                        <a href="{{ route('invoice.bayar.index', ['id' => $invoice->id]) }}"
                                                            class="d-flex align-items-center gap-2 dropdown-item">
                                                            <i class="ti ti-cash fs-6"></i>
                                                            <p class="mb-0 fs-3">Bayar</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @php
                                    $counter+=1;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#listorder2').DataTable();
        });
    </script>
@endsection