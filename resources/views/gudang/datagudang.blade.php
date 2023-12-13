@extends('layouts.app')

@section('title')
    Data Gudang Page
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Data Gudang</h4>
                </div>
                <div class="card-body h5 text-dark">
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                        id="listbarang">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Tanggal Beli</th>
                                <th>Harga Beli</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_barang as $barang)
                                @csrf
                                <tr id="tr_{{ $barang->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td id="td_nama_{{ $barang->id }}">{{ $barang->jenis->nama }}</td>
                                    <td id="td_qty_{{ $barang->id }}">{{ $barang->qty }}</td>
                                    <td id="td_satuan_{{ $barang->id }}">{{ $barang->satuan }}</td>
                                    <td id="td_satuan_{{ $barang->id }}">{{ $barang->tanggalBeli }}</td>
                                    <td id="td_satuan_{{ $barang->id }}">@currency($barang->hargaBeli)</td>
                                    <td>
                                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link nav-icon-hover" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-settings"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                                                    <div class="message-body">
                                                        <a href="{{ route('editgudang', ['id' => $barang->id]) }}"
                                                            class="d-flex align-items-center gap-2 dropdown-item">
                                                            <i class="ti ti-edit fs-6"></i>
                                                            <p class="mb-0 fs-3">Perbaruhi</p>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="hapus({{ $barang->id }})"
                                                            class="d-flex align-items-center gap-2 dropdown-item">
                                                            <i class="ti ti-trash fs-6"></i>
                                                            <p class="mb-0 fs-3">Hapus</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Tanggal Beli</th>
                                <th>Harga Beli</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Begin Edit Modal --}}
    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="updateModalLabel">Detail Gudang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="editQtyBarang">QTY</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                        <input type="text" id="editQtyBarang" class="form-control"
                                            placeholder="QTY" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="editSatuanBarang">No Telpon</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                        <input type="text" id="editNoHpPelanggan" class="form-control"
                                            placeholder="No Telpon" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="editAlamatPelanggan">Alamat</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-address-book"></i></span>
                                        <input type="text" id="editAlamatPelanggan" class="form-control"
                                            placeholder="Alamat" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="buttonPerbaruhi">Perbaruhi</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Edit Modal --}}
    {{-- Begin Delete Modal --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Apakah kamu yakin untuk menghapus data ini?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="buttonHapus">Ya</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}
    {{-- Begin Alert Modal --}}
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
    {{-- End Alert Modal --}}
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            // $('#listbarang').DataTable();
            var table = $('#listbarang').DataTable( {
              lengthChange: false,
              buttons: [ 
                'copy', 
                {
                  extend: 'excel',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                  },
                },
                {
                  extend: 'pdf',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                  },
                },
                'colvis' 
              ],
            } );
    
            table.buttons().container()
                .appendTo( '#listbarang_wrapper .col-md-6:eq(0)' );
            });

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

        function getData(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.detailpelanggan') }}",
                type: 'POST',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    document.getElementById('editNamaPelanggan').value = response.data.nama_pelanggan;
                    document.getElementById('editNoHpPelanggan').value = response.data.nohp_pelanggan;
                    document.getElementById("editAlamatPelanggan").value = response.data.alamat_pelanggan;
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function ubah(id) {
            getData(id);
            $('#updateModal').modal('show');
            $('#buttonPerbaruhi').attr('onclick', 'updatePelanggan(' + id + ')');
        }

        function updatePelanggan(id) {
            var nama = document.getElementById("editNamaPelanggan").value;
            var nohp = document.getElementById("editNoHpPelanggan").value;
            var alamat = document.getElementById("editAlamatPelanggan").value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.updatepelanggan') }}",
                type: 'POST',
                data: {
                    'id': id,
                    'nama_pelanggan': nama,
                    'nohp_pelanggan': nohp,
                    'alamat_pelanggan': alamat,
                },
                dataType: 'json',
                success: function(response) {
                    $('#updateModal').modal('hide');
                    $('#td_nama_'+id).html(nama);
                    $('#td_nohp_'+id).html(nohp);
                    $('#td_alamat_'+id).html(alamat);
                    alertUpdate(response.msg, response.status);
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function deleteGudang(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('deletegudang') }}",
                type: 'POST',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    alertUpdate(response.msg, response.status);
                    var table = $('#listbarang').DataTable();
                    table.row('#tr_'+id).remove().draw();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function hapus(id) {
            $('#deleteModal').modal('show');
            $('#buttonHapus').attr('onclick', 'deleteGudang(' + id + ')');
        }
    </script>
@endsection
