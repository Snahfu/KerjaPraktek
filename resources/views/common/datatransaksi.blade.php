@extends('layouts.app')

@section('title')
    Data Transaksi Page
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Tabel Quotation</h4>
                </div>
                <div class="card-body text-dark">
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                        id="listorder2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Jumlah Kontrak</th>
                                <th>Sub Devisi</th>
                                <th>Status</th>
                                {{-- Draft, Menunggu Persetujuan, Diproses, Diterima, Event Berlangsung, Selesai, Tagihan --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td>No</td>
                            <td>Nama Acara</td>
                            <td>Jumlah Kontrak</td>
                            <td>Sub Devisi</td>
                            <td>Status</td>
                            <td>
                                {{-- Button --}}
                                <div class="button">
                                    {{-- <i class="ti ti-edit"></i> --}}
                                    <p class="mb-0 fs-3">Detail</p>
                                </div>
                                {{-- <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                    <li class="nav-item dropdown">
                                        <div class="nav-link nav-icon-hover" id="dropaction" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                            aria-labelledby="dropaction">
                                            <div class="message-body">
                                                Kalau mau redirect div class diganti jadi a href class
                                                <div class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-edit"></i>
                                                    <p class="mb-0 fs-3">Detail</p>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-file-text"></i>
                                                    <p class="mb-0 fs-3">Cetak PDF</p>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-refresh"></i>
                                                    <p class="mb-0 fs-3">Change Status</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul> --}}
                            </td>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Jumlah Kontrak</th>
                                <th>Sub Devisi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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
