@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('template/assets/css/dashboard.css') }}" />
@endsection

@section('content')
    {{-- isinya kyk summary dari masing masing contoh persentase / jumlah transaksi total / penghasilan dsbnya --}}
    <div class="square">
        <div class="menu-container">
            <div class="menu-row">
                <a class="menu-item" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">Data Pelanggan</span>
                </a>
                <a class="menu-item" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-timeline"></i>
                    </span>
                    <span class="hide-menu">Transaksi Penjualan</span>
                </a>
            </div>
            <div class="menu-row">
                <a class="menu-item" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-report-analytics"></i>
                    </span>
                    <span class="hide-menu">Laporan Penjualan</span>
                </a>  
                <a class="menu-item" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-plus"></i>
                    </span>
                    <span class="hide-menu">Tambah Order</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection