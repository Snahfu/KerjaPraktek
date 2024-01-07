@extends('layouts.app')

@section('title')
    Data Penawaran
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Tabel Invoice</h4>
                </div>
                <div class="card-body text-dark">
                    <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                        id="listorder2">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Nama Acara</th>
                                <th>Tanggal Acara</th>
                                <th>Nama Client</th>
                                <th>PIC</th>
                                <th>Status Invoice</th>
                                {{-- Draft, Menunggu Persetujuan, Diproses, Diterima, Event Berlangsung, Selesai, Tagihan --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->nama }}</td>
                                    <td>{{ $invoice->tanggal }}</td>
                                    <td>{{ $invoice->sapaan }} {{ $invoice->nama_pelanggan }}</td>
                                    <td>{{ $invoice->namaPIC }}</td>
                                    <td id='td_status_{{ $invoice->id }}'>{{ $invoice->status }}</td>
                                    <td>
                                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link nav-icon-hover" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-settings"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                                                    <div class="message-body">
                                                        <a href="{{ route('invoice.cetak', ['id' => $invoice->id]) }}"
                                                            class="d-flex align-items-center gap-2 dropdown-item">
                                                            <i class="ti ti-file-text fs-6"></i>
                                                            <p class="mb-0 fs-3">Cetak</p>
                                                        </a>
                                                        @if ($invoice->status != "Deal")
                                                            <a href="{{ route('invoice.detail', ['id' => $invoice->id]) }}"
                                                                class="d-flex align-items-center gap-2 dropdown-item" >
                                                                <i class="ti ti-edit fs-6"></i>
                                                                <p class="mb-0 fs-3">Edit</p>
                                                            </a>
                                                        @else
                                                            
                                                            <a href="{{ route('common.index.tambahevent2', ['id' => $invoice->id]) }}"
                                                                class="d-flex align-items-center gap-2 dropdown-item" >
                                                                <i class="ti ti-edit fs-6"></i>
                                                                <p class="mb-0 fs-3">Tambah Baru</p>
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->divisi_id == 5)
                                                            <a id="set_setujui_{{ $invoice->id }}" {!! $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai'
                                                                ? ''
                                                                : 'onclick="updateStatus(' . "'Disetujui'" . ', ' . $invoice->id . ')"' !!}
                                                                class="d-flex align-items-center gap-2 dropdown-item text-dark {{ $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai' ? 'bg-light' : 'bg-success' }}">
                                                                <i class="ti ti-transform fs-6"></i>
                                                                <p class="mb-0 fs-3">Setujui</p>
                                                            </a>
                                                            <a id="set_tolak_{{ $invoice->id }}" {!! $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai'
                                                                ? ''
                                                                : 'onclick="updateStatus(' . "'Ditolak'" . ', ' . $invoice->id . ')"' !!}
                                                                class="d-flex align-items-center gap-2 dropdown-item text-dark {{ $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai' ? 'bg-light' : 'bg-danger' }}">
                                                                <i class="ti ti-transform fs-6"></i>
                                                                <p class="mb-0 fs-3">Tolak</p>
                                                            </a>
                                                        @endif
                                                        <a id="set_deal_{{ $invoice->id }}" {!! $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai'
                                                            ? ''
                                                            : 'onclick="updateStatus(' . "'Deal'" . ', ' . $invoice->id . ')"' !!}
                                                            class="d-flex align-items-center gap-2 dropdown-item text-dark {{ $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai' ? 'bg-light' : 'bg-primary' }}">
                                                            <i class="ti ti-transform fs-6"></i>
                                                            <p class="mb-0 fs-3">Deal</p>
                                                        </a>
                                                        <a id="set_batal_{{ $invoice->id }}" {!! $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai'
                                                            ? ''
                                                            : 'onclick="updateStatus(' . "'Batal'" . ', ' . $invoice->id . ')"' !!}
                                                            class="d-flex align-items-center gap-2 dropdown-item text-dark {{ $invoice->status == 'Deal' || $invoice->status == 'Batal' || $invoice->status == 'Selesai' ? 'bg-light' : 'bg-info' }}">
                                                            <i class="ti ti-transform fs-6"></i>
                                                            <p class="mb-0 fs-3">Batal</p>
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
                                <th>No Invoice</th>
                                <th>Nama Acara</th>
                                <th>Tanggal Acara</th>
                                <th>Nama Client</th>
                                <th>PIC</th>
                                <th>Status Invoice</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
        $(document).ready(function() {
            $('#listorder2').DataTable();
        });

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

        // function cetakDownload(id){
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: "{{ route('invoice.cetak') }}",
        //         type: 'POST',
        //         data: {
        //             'invoice_id': id,
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             console.log(response)
        //         },
        //         error: function(error) {
        //             console.log('Error:', error);
        //         }
        //     });
        // }

        function updateStatus(status_baru, id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('invoice.ubahstatus') }}",
                type: 'POST',
                data: {
                    'invoice_id': id,
                    'status_baru': status_baru,
                },
                dataType: 'json',
                success: function(response) {
                    $('#td_status_' + id).html(status_baru);
                    if (status_baru == "Deal" || status_baru == "Batal" || status_baru == "Selesai") {
                        const tombol_tolak = document.getElementById('set_tolak_' + id)
                        const tombol_setujui = document.getElementById('set_setujui_' + id)
                        const tombol_deal = document.getElementById('set_deal_' + id)
                        const tombol_batal = document.getElementById('set_batal_' + id)
                        tombol_tolak.removeAttribute('onclick');
                        tombol_setujui.removeAttribute('onclick');
                        tombol_deal.removeAttribute('onclick');
                        tombol_batal.removeAttribute('onclick');
                    }

                    alertUpdate(response.msg, response.status)
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }
    </script>
@endsection
