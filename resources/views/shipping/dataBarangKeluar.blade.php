@extends('layouts.app')

@section('title')
    Data Gudang Page
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Data Barang Keluar</h4>
                </div>
                <div class="col-sm-9">
                    <input type="date" id="tanggal" class="form-control"
                        name="tanggal" />
                </div>
                <div class="card-body h5 text-dark">
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                        id="listbarang">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Event</th>
                                <th>Barang Keluar</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                @csrf
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->invoice->event->nama }}</td>
                                    <td>{{ $data->barang->jenis->nama }}</td>
                                    <td>{{ $data->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nama Event</th>
                                <th>Barang keluar</th>
                                <th>Quantity</th>
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
                    <button id="alertModalButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Alert Modal --}}
@endsection

@section('javascript')
    <script>
            document.getElementById('tanggal').valueAsDate = new Date();
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth()+1;
            const date = currentDate.getDate();
            const hour = currentDate.getHours();
            const minute = currentDate.getMinutes();
            const second = currentDate.getSeconds();
            var table = $('#listbarang').DataTable( {
              "aaSorting": [[1,'asc']],
              lengthChange: false,
              buttons: [ 
                'copy', 
                {
                  extend: 'excel',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                  },
                  title: `Data Shipping ${year}-${month}-${date}-${hour}.${minute}.${second}`,
                },
                {
                  extend: 'pdf',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                  },
                  title: `Data Shipping ${year}-${month}-${date}-${hour}.${minute}.${second}`,
                  customize: function (doc) {
                    // Create footer
                    // Left side: tanggal report dicetak
                    // Right side: detail halaman
                    doc['footer']=(function(page, pages) {
                      return {
                        columns: [
                          {
                            alignment: 'left',
                            text: ['Created on: ', { text: `${year}-${month}-${date}-${hour}.${minute}.${second}` }]
                          },
                          {
                            alignment: 'right',
                            text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
                          }
                        ],
                        margin: 20
                      }
                    });
                  }
                },
                'colvis' 
              ],
            } );
    
            table.buttons().container()
                .appendTo( '#listbarang_wrapper .col-md-6:eq(0)' );

            $('#tanggal').on('change', function() {
              table.clear().draw();
              dateValue = document.getElementById('tanggal').value;
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  url: "{{ route('getbarangoutpost') }}",
                  type: 'POST',
                  data: {
                      'date': dateValue,
                  },
                  dataType: 'json',
                  success: function(response) {
                    let i = 1;
                      response.datas.forEach(data => {
                        table.row.add([
                          i,
                          data.invoice.event.nama,
                          data.barang.jenis.nama,
                          data.qty
                        ]).draw();
                        i += 1;
                      });
                  },
                  error: function(error) {
                      console.log('Error:', error);
                  }
              });
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

        function hapus(id) {
            $('#deleteModal').modal('show');
            $('#buttonHapus').attr('onclick', 'deleteBarang(' + id + ')');
        }
    </script>
@endsection
