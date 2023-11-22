@extends('layouts.app')

@section('title')
    Tambah Pelanggan Page
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Input Data Pelanggan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="inputNamaPelanggan">Nama Pelanggan</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                        <input type="text" id="inputNamaPelanggan" class="form-control"
                                            placeholder="Nama Pelanggan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="inputNoHpPelanggan">No Telpon</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                        <input type="text" id="inputNoHpPelanggan" class="form-control"
                                            placeholder="No Telpon" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="inputAlamatPelanggan">Alamat</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-address-book"></i></span>
                                        <input type="text" id="inputAlamatPelanggan" class="form-control"
                                            placeholder="Alamat" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 offset-sm-10">
                            <button type="submit" class="btn btn-primary me-1" onclick="tambahPelanggan()">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" id="resetData">Reset</button>
                        </div>
                    </div>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Alert End --}}
@endsection

@section('javascript')
    <script>
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

        document.getElementById("resetData").addEventListener("click", function() {
            document.getElementById("inputNamaPelanggan").value = "";
            document.getElementById("inputNoHpPelanggan").value = "";
            document.getElementById("inputAlamatPelanggan").value = "";
        });

        function tambahPelanggan() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.tambahpelanggan') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'nama_pelanggan': document.getElementById("inputNamaPelanggan").value,
                    'nohp_pelanggan': document.getElementById("inputNoHpPelanggan").value,
                    'alamat_pelanggan': document.getElementById("inputAlamatPelanggan").value,
                },
                success: function(response) {
                    alertUpdate(response.msg, response.status);
                    document.getElementById("inputNamaPelanggan").value = "";
                    document.getElementById("inputNoHpPelanggan").value = "";
                    document.getElementById("inputAlamatPelanggan").value = "";
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }
    </script>
@endsection
