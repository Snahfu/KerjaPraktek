@extends('layouts.app')

@section('title')
    Edit Shipping Page
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Data Shipping</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="{{ $shipping->id }}">
                        <!-- Nama Event -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="event">Event</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="event" disabled>
                                        @foreach ($event as $e)
                                            @if ($shipping->events_id == $e->id)
                                                <option value="{{$e->id}}" selected>{{$e->nama}}</option>
                                            @else
                                                <option value="{{$e->id}}">{{$e->nama}}</option>
                                            @endif  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Jenis -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="jenis">Jenis</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="jenis" onchange="updateBarang()">
                                        @if ($shipping->jenis == "Kirim")
                                            <option value="Kirim" selected>Kirim</option>
                                            <option value="Jemput">Jemput</option>
                                        @else
                                            <option value="Kirim">Kirim</option>
                                            <option value="Jemput" selected>Jemput</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl-input">Tanggal Input</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" id="tgl-input" class="form-control"
                                        name="tgl-input" value="{{ $shipping->tglInput }}" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl-event">Tanggal Event Berjalan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" id="tgl-event" class="form-control"
                                        name="tgl-event" value="{{ $shipping->tglJalan }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Driver -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="driver">Driver</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="driver">
                                        @foreach ($karyawan as $k)
                                        @if ($shipping->driver == $k->id)
                                            <option value="{{$k->id}}" selected>{{$k->nama}}</option>
                                        @else
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 id="forNothing"></h2>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->

    <div class="row detail-barang">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Table Detail Barang</h4>
                </div>
                <div class="card-body h5 text-dark">
                    <table class="table caption-top table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Barang</th>
                                <th>Quantity</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="data_table">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary me-1 detail-barang" onclick="updateDatabase()">Submit</button>
    <button type="reset" class="btn btn-outline-secondary detail-barang" onclick="resetAll()">Reset</button>

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

    {{-- Begin Edit Modal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Ubah Spesifikasi Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="edit_id_barang">ID Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" disabled id="edit_id_barang" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Quantity</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" value="1" min="1" id="edit_quantity_barang"
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnPerbaruhi"
                        onclick="perbaruhiDataTabel()">Perbaruhi</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Edit Modal --}}
@endsection

@section('javascript')
    <script>
        // Array untuk menyimpan data spesifikasi order pada tabel
        var arraySpesifikasiJson = Object.values(@json($array_jenis));
        // Maping untuk menampilkan nama jenis pada comboboxnya
        var jenis_map = @json($jenis_map);
        
        $(document).ready(function() {
            updateBarang();
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

        // Menghapus semua option pada selectElement
        function hapusOptionPadaSelect(selectElement) {
            while (selectElement.options.length > 0) {
                selectElement.remove(0);
            }
        }

        // Melakukan update barang pada comboBox nama-barang
        function updateBarang() {
            arraySpesifikasiJson = Object.values(@json($array_jenis));
            var idEvent = document.getElementById('event').value;
            var jenis = document.getElementById('jenis').value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('getbarangeditshipping') }}",
                type: 'POST',
                data: {
                    'id': idEvent,
                    'jenis':jenis,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == "failed") {
                        alertModalTitle.classList.remove('bg-success');
                        alertModalTitle.classList.add('bg-danger');
                        $('#responseController').html(response.msg);
                        $('#alertModal').modal('show');
                    } else {
                        let elementShow = document.getElementsByClassName('detail-barang');

                        if(jenis === "Kirim") {
                            if(Object.keys(response.datas).length === 0) {
                                for (var i = 0; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = 'none';
                                }

                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "Tidak ada barang yang dikirim";
                            } else {
                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "";

                                for (var i = 0; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = '';
                                }
        
                                for (var data in response.datas) {
                                    // Isi tabel detail barang
                                    var spesifikasiBarang = {
                                        idbarang: response.datas[data].id,
                                        idjenis: response.datas[data].idjenis,
                                        jenis: response.datas[data].jenis,
                                        quantity: response.datas[data].qty,
                                    }

                                    arraySpesifikasiJson[response.datas[data].idjenis].push(spesifikasiBarang);
                                }
                                updateTabel();
                            }
                        } else {
                            if(Object.keys(response.datas).length === 0) {
                                for (var i = 0; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = 'none';
                                }

                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "Tidak ada barang yang dijemput";
                            } else {
                                for (var i = 1; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = '';
                                }

                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "";

                                for (var data in response.datas) {
                                    // Isi tabel detail barang
                                    var spesifikasiBarang = {
                                        idbarang: response.datas[data].id,
                                        idjenis: response.datas[data].idjenis,
                                        jenis: response.datas[data].jenis,
                                        quantity: response.datas[data].qty,
                                    }
    
                                        arraySpesifikasiJson[response.datas[data].idjenis].push(spesifikasiBarang);
                                }
                                updateTabel();
                            }
                        }
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Melakukan update UI pada tabel agar sesuai dengan tampilannya
        function updateTabel() {
            var stringHTML = ``;
            for (var i = 0; i < arraySpesifikasiJson.length; i++) {
                if (arraySpesifikasiJson[i].length > 0) {
                    stringHTML += `<tr><td colspan="4">${jenis_map[i]}</td></tr>`
                    for (var j = 0; j < arraySpesifikasiJson[i].length; j++) {
                        stringHTML +=
                            `
                            <tr id='barang_${arraySpesifikasiJson[i][j].idbarang}'>
                                <td></td>
                                <td>${arraySpesifikasiJson[i][j].idbarang}</td>
                                <td>${arraySpesifikasiJson[i][j].quantity}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" onclick="editDataTabel(${arraySpesifikasiJson[i][j].idbarang})">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger" onclick="hapusDataTabel(${arraySpesifikasiJson[i][j].idbarang})">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            `
                    }
                }
                document.getElementById('data_table').innerHTML = stringHTML;
            }
        }

        // Menghapus data tabel baik tampilan maupun pada arraySpesifikasiOrder
        function hapusDataTabel(id) {
            var idBarangToDelete = parseInt(id);
            for (var key in arraySpesifikasiJson) {
                if (arraySpesifikasiJson.hasOwnProperty(key)) {
                    arraySpesifikasiJson[key] = arraySpesifikasiJson[key].filter(function(obj) {
                        return obj.idbarang != idBarangToDelete;
                    });
                }
            }
            updateTabel();
        }

        // Membuka modal edit untuk melakukan modifikasi terhadap spesifikasi barang tertentu
        function editDataTabel(id) {
            var tdList = $('#barang_' + id).find('td');
            var idBarang = tdList[1].textContent;
            var quantity = tdList[2].textContent;
            document.getElementById('edit_quantity_barang').value = quantity
            $("#edit_quantity_barang").attr({
                "max" : quantity,
                "min" : 1
            });
            document.getElementById('edit_id_barang').value = idBarang
            $('#btnPerbaruhi').attr('onclick', 'perbaruhiDataTabel(' + id + ')');
            $('#editModal').modal('show');
        }

        // Function untuk memperbaruhi data yang diubah pada edit modal
        function updateArraySpesifikasiBarang(id, quantity) {
            for (var i = 0; i < arraySpesifikasiJson.length; i++) {
                if (arraySpesifikasiJson[i].length > 0) {
                    for (var j = 0; j < arraySpesifikasiJson[i].length; j++) {
                        if (arraySpesifikasiJson[i][j].idbarang == id) {
                            arraySpesifikasiJson[i][j].quantity = quantity
                        }
                    }
                }
            }
        }

        // Event trigger untuk melakukan perubahan pada spesifikasi order
        function perbaruhiDataTabel(id) {
            var tdList = $('#barang_' + id).find('td');
            var quantity = parseInt(document.getElementById('edit_quantity_barang').value);
            
            if(quantity > tdList[2].textContent) {
                quantity = tdList[2].textContent;
            } else if(quantity < tdList[2].textContent) {
                quantity = 1;
            }

            updateArraySpesifikasiBarang(id, quantity);
            updateTabel();
            $('#editModal').modal('hide');
        }

        // Function untuk simpan ke database
        function updateDatabase() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('updateshipping') }}",
                type: 'POST',
                data: {
                    'id': parseInt(document.getElementById('id').value),
                    'events_id': parseInt(document.getElementById('event').value),
                    'jenis': document.getElementById('jenis').value,
                    'driver': parseInt(document.getElementById('driver').value),
                    'tglJalan': document.getElementById('tgl-event').value,
                    'listbarang': arraySpesifikasiJson,
                },
                dataType: 'json',
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
            $("select#event").prop('selectedIndex', 0);
            $("select#jenis").prop('selectedIndex', 0);
            $("select#driver").prop('selectedIndex', 0);
            $("#quantity").val(1);
            $('#jenis_barang option[disabled]').prop('selected', true)
            $('#barang').empty();
            updateBarang();
            arraySpesifikasiJson = Object.values(@json($array_jenis));
            updateTabel();
        }
    </script>
@endsection