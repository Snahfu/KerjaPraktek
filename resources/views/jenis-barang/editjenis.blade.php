@extends('layouts.app')

@section('title')
    Edit Data Jenis Barang
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Data Jenis Barang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="{{ $jenis->id }}">
                        <!-- Nama -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="nama">Jenis Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="nama" class="form-control" name="nama" placeholder="Jenis Barang" value="{{ $jenis->nama }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Sewa -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="harga-sewa">Harga Sewa</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="harga-sewa" class="form-control" name="harga-sewa" placeholder="Harga Sewa" value="{{ $jenis->harga_sewa }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Kategori Barang -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="kategori">Kategori Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="kategori">
                                        @foreach ($kategori as $k)
                                            @if ($jenis->kategori_barang_id == $k->id)
                                                <option value="{{ $k->id }}" selected>{{ $k->nama }}
                                                </option>
                                            @else
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Spesifikasi -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="spesifikasi">Spesifikasi</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="spesifikasi" class="form-control" name="spesifikasi" placeholder="Spesifikasi Jenis Barang" value="{{ $jenis->spesifikasi }}"/>
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

        // Function untuk simpan ke database
        function updateDatabase() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('updatejenis') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id' : parseInt(document.getElementById('id').value),
                    'nama': document.getElementById('nama').value,
                    'harga_sewa': parseFloat(document.getElementById('harga-sewa').value),
                    'kategori_barang_id': parseInt(document.getElementById('kategori').value),
                    'spesifikasi': document.getElementById('spesifikasi').value,
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
        function resetAll(){
            $(':input').val('');
        }
    </script>
@endsection
