@extends('layouts.app')

@section('title')
    Edit Data Gudang
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Data Gudang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="{{ $barang->id }}">
                        <!-- Jenis Barang -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="jenis-barang">Jenis Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="jenis-barang">
                                        @foreach ($jenis as $j)
                                            @if ($barang->jenis_barang_id == $j->id)
                                                <option value="{{ $j->id }}" selected>{{ $j->nama }}
                                                </option>
                                            @else
                                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="quantity">Quantity</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" min="1" id="quantity" class="form-control" name="quantity"
                                        onchange="updateHarga()" placeholder="Quantity Barang"
                                        value="{{ $barang->qty }}" />
                                </div>
                            </div>
                        </div>

                        <!-- Satuan -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="satuan">Satuan</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="satuan">
                                        @if ($barang->satuan == "unit")
                                            <option value="unit" selected>Unit</option>
                                            <option value="set">Set</option>
                                        @else
                                            <option value="unit">Unit</option>
                                            <option value="set" selected>Set</option>
                                        @endif   
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Beli -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tanggal-beli">Tanggal Beli</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" id="tanggal-beli" class="form-control"
                                    name="tanggal-beli" value="{{ $barang->tanggalBeli }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Beli -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="harga-beli">Harga Beli per Item(Dalam Rupiah)</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="harga-beli" class="form-control" name="harga-beli" onchange="updateHarga()" placeholder="Harga Beli" value="{{ $barang->hargaBeli / $barang->qty }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Total Harga -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="">
                                    <label class="col-form-label">Subtotal barang item diatas adalah (Dalam Rupiah)</label>
                                    <input type="text" class="form-control-sm" id="harga_total"
                                        onchange="updateHarga()" value="{{ $barang->hargaBeli }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->

    <button type="submit" class="btn btn-primary me-1" onclick="updateDatabase()">Submit</button>
    <button type="reset" class="btn btn-outline-secondary" onclick="resetAll()">Reset</button>

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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Alert End --}}
@endsection

@section('javascript')
    <script>
        // Function untuk alert Message
        function alertUpdate(msg, status) {
            var alertModalTitle = document.getElementById('alertModalTitle');
            if (status == "success") {
                alertModalTitle.classList.remove('bg-danger');
                alertModalTitle.classList.add('bg-success');
                $('#responseController').html(msg);
                $('#alertModal').modal('show');
            } else {
                alertModalTitle.classList.remove('bg-success');
                alertModalTitle.classList.add('bg-danger');
                $('#responseController').html(msg);
                $('#alertModal').modal('show');
            }
        }

        // Melakukan update harga maupun subtotal jika terjadi perubahan pada input jumlah/harga/subtotal
        function updateHarga() {
            var quantity = parseInt(document.getElementById('quantity').value);
            var price = parseFloat(document.getElementById('harga-beli').value);
            var subtotal = parseFloat(document.getElementById('harga_total').value);

            if (event.target.id === 'quantity') {
                document.getElementById('harga_total').value = price ? quantity * price : 0;
            }

            if (event.target.id === 'harga-beli') {
                document.getElementById('harga_total').value = quantity * price;
            }

            if (event.target.id === 'harga_total') {
                document.getElementById('harga-beli').value = price !== 0 ? subtotal / quantity : 0;
            }
        }

        // Function untuk simpan ke database
        function updateDatabase() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('updategudang') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': parseInt(document.getElementById('id').value),
                    'jenis_barang_id': parseInt(document.getElementById('jenis-barang').value),
                    'qty': parseInt(document.getElementById('quantity').value),
                    'satuan': document.getElementById('satuan').value,
                    'tanggalBeli': document.getElementById('tanggal-beli').value,
                    'hargaBeli': parseFloat(document.getElementById('harga_total').value),
                },
                success: function(response) {
                    // Kalau success clear data
                    alertUpdate(response.msg, response.status)
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Function untuk reset semua input
        function resetAll() {
            $(':input').val('');
        }
    </script>
@endsection
