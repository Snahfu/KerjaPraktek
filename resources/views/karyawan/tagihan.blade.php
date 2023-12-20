@extends('layouts.app')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Tabel Tagihan</h4>
                </div>
                <div class="card-body text-dark">
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Acara</th>
                                <th>Termin Number</th>
                                <th>Termin Input</th>
                                <th>Termin Tagihan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td>Sample Data</td>
                            <td>Sample Data</td>
                            <td>Sample Data</td>
                            <td>Sample Data</td>
                            <td>Sample Data</td>
                            <td>Sample Data</td>
                            <td>
                                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-settings"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                                            <div class="message-body">
                                                <a href="javascript:void(0)" onclick="newtab()"
                                                    class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-message fs-6"></i>
                                                    <p class="mb-0 fs-3">Tagih</p>
                                                </a>
                                                <a href="javascript:void(0)" onclick="cetak()"
                                                    class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-file-invoice fs-6"></i>
                                                    <p class="mb-0 fs-3">Cetak PDF</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nama Acara</th>
                                <th>Termin Number</th>
                                <th>Termin Input</th>
                                <th>Termin Tagihan</th>
                                <th>Nominal</th>
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
@endsection
