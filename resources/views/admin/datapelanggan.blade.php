@extends('layouts.app')

@section('title')
    Data Pelanggan Page
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Data Pelanggan</h4>
                </div>
                <div class="card-body h5 text-dark">
                    <a href="/tambah-pelanggan" class="btn btn-primary mb-3"><i class="ti ti-plus"></i> Create New Data</a>
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                        id="listpelanggan">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_customer as $customer)
                                @csrf
                                <tr id="tr_{{ $customer->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td id="td_nama_{{ $customer->id }}">{{ $customer->nama_pelanggan }}</td>
                                    <td id="td_nohp_{{ $customer->id }}"><a href="http://wa.me/{{ $customer->nohp_pelanggan_wa }}">{{ $customer->nohp_pelanggan }}</a></td>
                                    <td id="td_alamat_{{ $customer->id }}">{{ $customer->alamat_pelanggan }}</td>
                                    <td>
                                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link nav-icon-hover" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-settings"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                                                    <div class="message-body">
                                                        <a href="{{ route('admin.editpelanggan', ['id' => $customer->id]) }}"
                                                            class="d-flex align-items-center gap-2 dropdown-item">
                                                            <i class="ti ti-edit fs-6"></i>
                                                            <p class="mb-0 fs-3">Perbaruhi</p>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="hapus({{ $customer->id }})"
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
                                <th>Name</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
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
                    <h5 class="modal-title" id="updateModalLabel">Detail Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="editNamaPelanggan">Nama Pelanggan</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                        <input type="text" id="editNamaPelanggan" class="form-control"
                                            placeholder="Nama Pelanggan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="editNoHpPelanggan">No Telpon</label>
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
        $(document).ready(function() {
            // $('#listpelanggan').DataTable();
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth()+1;
            const date = currentDate.getDate();
            const hour = currentDate.getHours();
            const minute = currentDate.getMinutes();
            const second = currentDate.getSeconds();
            var table = $('#listpelanggan').DataTable( {
              lengthChange: false,
              buttons: [ 
                'copy', 
                {
                  extend: 'excel',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                  },
                  title: `Data Pelanggan ${year}-${month}-${date}-${hour}.${minute}.${second}`,
                },
                {
                  extend: 'pdf',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3 ],
                  },
                  title: `Data Pelanggan`,
                  filename: `Data Pelanggan ${year}-${month}-${date}-${hour}.${minute}.${second}`,
                  customize: function (doc) {
                  	//Remove the title created by datatTables
                  // doc.content.splice(0,1);
                  //Create a date string that we use in the footer. Format is dd-mm-yyyy
                  // var now = new Date();
                  // var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                  // // Logo converted to base64
                  // // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                  // // The above call should work, but not when called from codepen.io
                  // // So we use a online converter and paste the string in.
                  // // Done on http://codebeautify.org/image-to-base64-converter
                  // // It's a LONG string scroll down to see the rest of the code !!!
                  // var logo;
                  // // A documentation reference can be found at
                  // // https://github.com/bpampuch/pdfmake#getting-started
                  // // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                  // // or one number for equal spread
                  // // It's important to create enough space at the top for a header !!!
                  // doc.pageMargins = [20,60,20,30];
                  // // Set the font size fot the entire document
                  // doc.defaultStyle.fontSize = 7;
                  // // Set the fontsize for the table header
                  // doc.styles.tableHeader.fontSize = 7;
                  // // Create a header object with 3 columns
                  // // Left side: Logo
                  // // Middle: brandname
                  // // Right side: A document title
                  // doc['header']=(function() {
                  //   return {
                  //     columns: [
                  //       {
                  //         image: logo,
                  //         width: 24
                  //       },
                  //       {
                  //         alignment: 'left',
                  //         italics: true,
                  //         text: 'dataTables',
                  //         fontSize: 18,
                  //         margin: [10,0]
                  //       },
                  //       {
                  //         alignment: 'right',
                  //         fontSize: 14,
                  //         text: 'Custom PDF export with dataTables'
                  //       }
                  //     ],
                  //     margin: 20
                  //   }
                  // });
                  // Create a footer object with 2 columns
                  // Left side: report creation date
                  // Right side: current page and total pages
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
                  // Change dataTable layout (Table styling)
                  // To use predefined layouts uncomment the line below and comment the custom lines below
                  // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                  // var objLayout = {};
                  // objLayout['hLineWidth'] = function(i) { return .5; };
                  // objLayout['vLineWidth'] = function(i) { return .5; };
                  // objLayout['hLineColor'] = function(i) { return '#aaa'; };
                  // objLayout['vLineColor'] = function(i) { return '#aaa'; };
                  // objLayout['paddingLeft'] = function(i) { return 4; };
                  // objLayout['paddingRight'] = function(i) { return 4; };
                  // doc.content[0].layout = objLayout;
              }
                },
                'colvis' 
              ],
            } );
    
            table.buttons().container()
                .appendTo( '#listpelanggan_wrapper .col-md-6:eq(0)' );
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

        function deletePelanggan(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.deletepelanggan') }}",
                type: 'POST',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    alertUpdate(response.msg, response.status);
                    var table = $('#listpelanggan').DataTable();
                    table.row('#tr_'+id).remove().draw();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function hapus(id) {
            $('#deleteModal').modal('show');
            $('#buttonHapus').attr('onclick', 'deletePelanggan(' + id + ')');
        }
    </script>
@endsection
