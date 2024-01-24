@extends('layouts.app')

@section('title')
    Halaman Bayar
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Form Input Data Pembayaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoice.bayar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Id Invoice -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="invoice_id">Id Invoice</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="invoice_id" readonly class="form-control"
                                            name="invoice_id" value={{ $invoice_data[0]->id }} />
                                    </div>
                                </div>
                            </div>

                            <!-- Nominal Pembayaran -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="nominal">Nominal Pembayaran</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" id="nominal" class="form-control" name="nominal"
                                            placeholder="Rp{{ number_format($harus_bayar, 0, ',', ',') }}" min="0" />
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Bukti Pembayaran -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="bukti_pembayaran">Bukti Pembayaran</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input id="bukti_pembayaran" type="file" class="form-control"
                                            name="bukti_pembayaran">
                                    </div>
                                </div>
                            </div>

                            <!-- Bayar Langsung Check Button-->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label"></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" onchange="ubahNominal()" value="Bayar Semua"
                                                id="lunaskan" name="lunaskan">
                                            <label class="form-check-label" for="lunaskan">
                                                Bayar Semua / Lunas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tulisan Yang Harus Dibayarkan -->
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label"></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label class="col-form-label text-danger" for="lunaskan">
                                            Biaya yang perlu dibayarkan Rp{{ number_format($sisa, 0, ',', ',') }} dari Rp{{ number_format($harus_bayar, 0, ',', ',') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Button Submit --}}
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label"></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary mb-3" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Alert Begin --}}
    <div class="modal fade" id="alertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="alertModalTitle" class="modal-header bg-success">
                    <h5 class="modal-title" id="alertModalLabel">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" id="responseController"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="alertModalButton" type="button" class="btn btn-primary"
                        data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Alert End --}}
@endsection

@section('javascript')
    <script>

        var harusBayar = @json($harus_bayar);

        $(document).ready(function() {

        });

        function ubahNominal(){
            var textboxNominal = document.getElementById('nominal');
            var checkbox = document.getElementById("lunaskan");
            if(checkbox.checked){
                textboxNominal.value = harusBayar;
            }
            else{
                textboxNominal.value = 0;
            }
        }
    </script>
@endsection
