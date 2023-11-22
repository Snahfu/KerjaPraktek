@extends('layouts.app')

@section('title')
    Quotation & Verification Page
@endsection

{{--  --}}

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Input Data Order</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal">
                        <div class="row">
                            <!-- Nama Acara -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-name">Nama Acara</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="event-name" class="form-control" name="event-name"
                                            placeholder="Nama Acara" />
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi Acara -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-location">Lokasi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="event-location" class="form-control" name="event-location"
                                            placeholder="Lokasi" />
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Client -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="client-name">Nama Client</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="client-name" class="form-control" name="client-name"
                                            placeholder="Nama Client" />
                                    </div>
                                </div>
                            </div>

                            <!-- Posisi Jabatan Client -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="client-position">Posisi Jabatan
                                            Client</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="client-position" class="form-control"
                                            name="client-position" placeholder="Posisi Jabatan Client" />
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Loading In -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="loading-in-date">Tanggal Loading In</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" id="loading-in-date" class="form-control"
                                            name="loading-in-date" />
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Acara Mulai -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-start-date">Tanggal Acara Mulai</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" id="event-start-date" class="form-control"
                                            name="event-start-date" />
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Acara Selesai -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-end-date">Tanggal Acara Selesai</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" id="event-end-date" class="form-control"
                                            name="event-end-date" />
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Loading Out -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="loading-out-date">Tanggal Loading Out</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" id="loading-out-date" class="form-control"
                                            name="loading-out-date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Spesifikasi Order</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-name">Kategori</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="event-name" class="form-control" name="event-name"
                                            placeholder="Nama Acara" />
                                        {{-- Combo Box --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-name">Item dari Kategori dalam
                                            ComboBox</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="event-name" class="form-control" name="event-name"
                                            placeholder="Nama Acara" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="event-name">Quantity</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="event-name" class="form-control" name="event-name"
                                            placeholder="Nama Acara" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="">
                                        <label class="col-form-label" for="event-name">Harga barang per item adalah (Dalam
                                            Rupiah)</label>
                                        <input type="text" class="form-control-sm" id="event-name"name="event-name"
                                            placeholder="Nama Acara" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="">
                                        <label class="col-form-label" for="event-name">Subtotal barang item diatas adalah
                                            (Dalam Rupiah)</label>
                                        <input type="text" class="form-control-sm" id="event-name"name="event-name"
                                            placeholder="Nama Acara" />
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary me-1">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->

    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Table Detail Order</h4>
                </div>
                <div class="card-body h5 text-dark">
                    <table class="table caption-top table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Barang</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">Sound System</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sound</td>
                                <td>1</td>
                                <td>1000000</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sound 2</td>
                                <td>3</td>
                                <td>1000000</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Ini Untuk Sisi Sales --}}
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Notes</h4>
            </div>
            <div class="card-body">
                <label class="col-form-label">Keterangan dari sisi Admin</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary me-1">Revisi</button>
    {{-- End --}}

    {{-- Ini sisi Admin --}}
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Notes</h4>
            </div>
            <div class="card-body">
                <input type="text" class="form-control mb-3" id="event-name"name="event-name"
                    placeholder="Keterangan Tambahan" />
                <button type="submit" class="btn btn-success me-1">Terima</button>
                <button type="submit" class="btn btn-danger me-1">Tolak</button>
            </div>
        </div>
    </div>
    {{-- End --}}
@endsection

@section('javascript')
@endsection
