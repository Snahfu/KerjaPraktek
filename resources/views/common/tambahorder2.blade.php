@extends('layouts.app')

@section('title')
    Tambah Order Page
@endsection

@section('content')
    <style>
        .error-label {
            display: none;
        }
    </style>
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Form Input Data Order</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id-event" name="id-event" value="{{ $detail_invoices[0]->id }}" />
                        <!-- Nama Acara -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="event-name">Nama Acara</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="event-name" class="form-control" name="event-name"
                                        placeholder="Nama Acara" readonly value="{{ $detail_invoices[0]->nama }}" />
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
                                        placeholder="Lokasi" readonly value="{{ $detail_invoices[0]->lokasi }}" />
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
                                    <select class="form-select" disabled id="client-name">
                                        @foreach ($semua_customer as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $detail_invoices[0]->customers_id == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->nama_pelanggan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Penyelenggara -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="penyelenggara">Nama Lembaga</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="penyelenggara" readonly class="form-control"
                                        name="penyelenggara" placeholder="Nama Lembaga"
                                        value="{{ $detail_invoices[0]->penyelenggara }}" />
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
                                    <input type="text" id="client-position" readonly class="form-control"
                                        name="client-position" placeholder="Posisi Jabatan Client"
                                        value="{{ $detail_invoices[0]->jabatan_client }}" />
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Kegiatan -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="jenis-kegiatan">Jenis Kegiatan</label>
                                </div>
                                <div class="col-sm-9">
                                    <select type="text" class="form-select" disabled id="jenis-kegiatan">
                                        @foreach ($array_jenisKegiatan as $jeniskegiatan)
                                            <option value="{{ $jeniskegiatan }}"
                                                {{ $detail_invoices[0]->jenis_kegiatan == $jeniskegiatan ? 'selected' : '' }}>
                                                {{ $jeniskegiatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Tanggal Acara -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tanggal-acara">Tanggal Acara</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" readonly id="tanggal-acara" class="form-control"
                                        name="tanggal-acara" value="{{ $detail_invoices[0]->tanggal }}" />
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
                                    <input type="datetime-local" readonly id="loading-in-date" class="form-control"
                                        name="loading-in-date" value="{{ $detail_invoices[0]->waktu_loading }}" />
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
                                    <input type="datetime-local" readonly id="event-start-date" class="form-control"
                                        name="event-start-date" value="{{ $detail_invoices[0]->jam_mulai_acara }}" />
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
                                    <input type="datetime-local" readonly id="event-end-date" class="form-control"
                                        name="event-end-date" value="{{ $detail_invoices[0]->jam_selesai_acara }}" />
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
                                    <input type="datetime-local" readonly id="loading-out-date" class="form-control"
                                        name="loading-out-date" value="{{ $detail_invoices[0]->waktu_loading_out }}" />
                                </div>
                            </div>
                        </div>
                        <!-- Budget -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="budget">Budget</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" id="budget" readonly class="form-control" name="budget"
                                        value="{{ $detail_invoices[0]->budget }}" />
                                </div>
                            </div>
                        </div>
                        <!-- Catatan -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="catatan">Catatan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="catatan" readonly class="form-control" name="catatan"
                                        value="{{ $detail_invoices[0]->catatan }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Spesifikasi Order</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="kategori_barang">Kategori</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="kategori_barang" onchange="updateBarang()">
                                        <option value="none" disabled selected> -- Pilih Kategori -- </option>
                                        @foreach ($kategori_map as $key => $nama)
                                            <option value="{{ $key }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    {{-- Combo Box --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="nama_barang">Nama Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="nama_barang" disabled onchange="updateHargaSewa()">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Quantity</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" value="1" min="1" id="jumlah_barang"
                                        class="form-control" onchange="updateHarga()" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label text-danger" id="stocksisa"></label><label
                                        class="col-form-label text-danger" id="stock"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="">
                                    <label class="col-form-label">Harga barang per item adalah (Dalam Rupiah)</label>
                                    <input type="text" class="form-control-sm" id="harga_per_barang"
                                        onchange="updateHarga()" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="">
                                    <label class="col-form-label">Subtotal barang item diatas adalah (Dalam
                                        Rupiah)</label>
                                    <input type="text" class="form-control-sm" id="harga_total"
                                        onchange="updateHarga()" />
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-1" onclick="tambahSpesifikasi()">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->

    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Table Detail Order</h4>
                </div>
                <div class="card-body h5 text-dark">
                    <table class="table caption-top table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Barang</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
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

    <button type="submit" class="btn btn-primary me-1" onclick="insertDatabase()">Submit</button>
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
                    <form action="{{ route('invoice.list') }}">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                    </form>
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
                    <h5 class="modal-title">Ubah Spesifikasi Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="edit_nama_barang">Nama Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" disabled id="edit_nama_barang" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Quantity</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" value="1" min="1" id="edit_jumlah_barang"
                                        class="form-control" onchange="editUpdateHarga()" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label text-danger">Stock yang tersedia: </label><label
                                        class="col-form-label text-danger" id="stockupdate"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="">
                                    <label class="col-form-label">Harga barang per item adalah (Dalam Rupiah)</label>
                                    <input type="text" class="form-control-sm" id="edit_harga_per_barang"
                                        onchange="editUpdateHarga()" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="">
                                    <label class="col-form-label">Subtotal barang item diatas adalah (Dalam
                                        Rupiah)</label>
                                    <input type="text" class="form-control-sm" id="edit_harga_total"
                                        onchange="editUpdateHarga()" />
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
        var arraySpesifikasiJson = Object.values(@json($array_kategori));
        // var arraySpesifikasiJson = @json($array_kategori);
        // Maping untuk menampilkan nama kategori pada comboboxnya
        var kategori_map = @json($kategori_map);
        // Maping untuk menyimpan harga dari setiap barang
        var harga_sewa_map = [];

        $(document).ready(function() {
            console.log(arraySpesifikasiJson);
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

        function siapTambahBarang() {
            var inputDateTime = document.getElementById('loading-out-date').value;
            var inputDateTime2 = document.getElementById('loading-in-date').value;

            if (inputDateTime && inputDateTime2) {
                // Jika inputDateTime dan inputDateTime2 sudah terisi
                namaBarangElement = document.getElementById("kategori_barang")
                jumlahBarangElement = document.getElementById("jumlah_barang")
                hargaBarangElement = document.getElementById("harga_per_barang")
                hargaTotalElement = document.getElementById("harga_total")

                // Mengaktifkan elemen yang sebelumnya dinonaktifkan
                namaBarangElement.disabled = false;
                jumlahBarangElement.disabled = false;
                hargaBarangElement.disabled = false;
                hargaTotalElement.disabled = false;

                // Menyembunyikan pesan error jika sebelumnya ditampilkan
                hideErrorLabel('loading-out-error');
                hideErrorLabel('loading-in-error');
            } else {
                // Jika inputDateTime atau inputDateTime2 belum terisi
                if (!inputDateTime) {
                    // Menampilkan pesan error untuk loading-out-date
                    showErrorLabel('loading-out-error', 'Tanggal Loading Out harus diisi terlebih dahulu.');
                }

                if (!inputDateTime2) {
                    // Menampilkan pesan error untuk loading-in-date
                    showErrorLabel('loading-in-error', 'Tanggal Loading In harus diisi terlebih dahulu.');
                }
            }
        }

        function showErrorLabel(labelId, errorMessage) {
            var errorLabel = document.getElementById(labelId);
            errorLabel.innerHTML = errorMessage;
            errorLabel.style.display = 'block'; // Menampilkan label
        }

        function hideErrorLabel(labelId) {
            var errorLabel = document.getElementById(labelId);
            errorLabel.innerHTML = ''; // Menghapus teks error
            errorLabel.style.display = 'none'; // Menyembunyikan label
        }
        // Melakukan update barang pada comboBox nama-barang
        function updateBarang() {
            var selectElement = document.getElementById('kategori_barang');
            var selectedIndex = selectElement.selectedIndex;
            var id = selectElement.options[selectedIndex].value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('common.getbarang') }}",
                type: 'POST',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == "failed") {
                        alertModalTitle.classList.remove('bg-success');
                        alertModalTitle.classList.add('bg-danger');
                        $('#responseController').html(response.msg);
                        $('#alertModal').modal('show');
                    } else {
                        namaBarangElement = document.getElementById("nama_barang")
                        namaBarangElement.disabled = false;

                        hapusOptionPadaSelect(namaBarangElement);

                        var optionSelected = document.createElement('option');
                        optionSelected.value = -1;
                        optionSelected.text = "-- Pilih Barang --";
                        optionSelected.disabled = true;
                        optionSelected.selected = true;
                        namaBarangElement.add(optionSelected);
                        harga_sewa_map = [];
                        for (var data in response.datas) {
                            var option = document.createElement('option');
                            option.value = response.datas[data].id;
                            option.text = response.datas[data].nama;
                            namaBarangElement.add(option);
                            harga_sewa_map[response.datas[data].id] = response.datas[data]
                                .harga_sewa;
                        }
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Melakukan update harga per barang jika terjadi perubahan pada input nama-barang
        function updateHargaSewa() {
            var selectElement = document.getElementById('nama_barang');
            var selectedIndex = selectElement.selectedIndex;
            var id = selectElement.options[selectedIndex].value;
            var hargaSewa = harga_sewa_map[id];
            document.getElementById('jumlah_barang').value = 1;
            document.getElementById('harga_per_barang').value = hargaSewa;
            document.getElementById('harga_total').value = hargaSewa * 1;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('common.getstock') }}",
                type: 'POST',
                data: {
                    'tanggal_out': document.getElementById('loading-out-date').value,
                    'tanggal_in': document.getElementById('loading-in-date').value,
                    'id_jenis_barangs': id,
                },
                dataType: 'json',
                success: function(response) {
                    document.getElementById('stocksisa').innerHTML = "Stock yang tersedia: "
                    document.getElementById('stock').innerHTML = response.sisa
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Melakukan update harga maupun subtotal jika terjadi perubahan pada input jumlah/harga/subtotal
        function updateHarga() {
            var quantity = parseFloat(document.getElementById('jumlah_barang').value);
            var price = parseFloat(document.getElementById('harga_per_barang').value);
            var subtotal = parseFloat(document.getElementById('harga_total').value);

            if (event.target.id === 'jumlah_barang') {
                document.getElementById('harga_total').value = quantity * price;
            }

            if (event.target.id === 'harga_per_barang') {
                document.getElementById('harga_total').value = quantity * price;
            }

            if (event.target.id === 'harga_total') {
                document.getElementById('harga_per_barang').value = price !== 0 ? subtotal / quantity : 0;
            }
        }

        // Menambahkan data spesifikasi order ke dalam tabel
        function tambahSpesifikasi() {
            var barangElement = document.getElementById('nama_barang');
            var barangIndex = barangElement.selectedIndex;
            var id = barangElement.options[barangIndex].value;
            var nama_barang = barangElement.options[barangIndex].text;

            var kategoriElement = document.getElementById('kategori_barang');
            var selectedIndex = kategoriElement.selectedIndex;
            var kategori = kategoriElement.options[selectedIndex].value;

            var jumlah = parseFloat(document.getElementById('jumlah_barang').value);
            var harga = parseFloat(document.getElementById('harga_per_barang').value);
            var subtotal = parseFloat(document.getElementById('harga_total').value);
            var stock = parseFloat(document.getElementById('stock').innerHTML);

            if (jumlah <= stock) {
                var spesifikasiBarang = {
                    idbarang: id,
                    nama: nama_barang,
                    kategori: kategori,
                    jumlah: jumlah,
                    harga: harga,
                    subtotal: subtotal
                }

                arraySpesifikasiJson[kategori - 1].push(spesifikasiBarang);
                console.log(arraySpesifikasiJson);
                updateTabel();
            } else {
                alertUpdate("Stock Tidak Tersedia", "error")
            }
        }

        // Melakukan update UI pada tabel agar sesuai dengan tampilannya
        function updateTabel() {
            var stringHTML = ``;
            for (var i = 0; i < arraySpesifikasiJson.length; i++) {
                if (arraySpesifikasiJson[i].length > 0) {
                    stringHTML += `<tr><td colspan="6">${kategori_map[i+1]}</td></tr>`
                    for (var j = 0; j < arraySpesifikasiJson[i].length; j++) {
                        stringHTML +=
                            `
                            <tr id='barang_${arraySpesifikasiJson[i][j].idbarang}'>
                                <td></td>
                                <td>${arraySpesifikasiJson[i][j].nama}</td>
                                <td>${arraySpesifikasiJson[i][j].jumlah}</td>
                                <td>${arraySpesifikasiJson[i][j].harga}</td>
                                <td>${arraySpesifikasiJson[i][j].subtotal}</td>
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

        // Membuka modal edit untuk melakukan modifikasi terhadap spesifikasi order tertentu
        function editDataTabel(id) {
            var tdList = $('#barang_' + id).find('td');
            var namaBarang = tdList[1].textContent;
            var jumlah = tdList[2].textContent;
            var harga = tdList[3].textContent;
            var subtotal = tdList[4].textContent;
            document.getElementById('edit_jumlah_barang').value = jumlah
            document.getElementById('edit_harga_per_barang').value = harga
            document.getElementById('edit_harga_total').value = subtotal
            document.getElementById('edit_nama_barang').value = namaBarang
            $('#btnPerbaruhi').attr('onclick', 'perbaruhiDataTabel(' + id + ')');

            // Get Stock
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('common.getstock2') }}",
                type: 'POST',
                data: {
                    'tanggal_out': document.getElementById('loading-out-date').value,
                    'tanggal_in': document.getElementById('loading-in-date').value,
                    'nama_jenis_barang': namaBarang,
                },
                dataType: 'json',
                success: function(response) {
                    document.getElementById('stockupdate').innerHTML = response.sisa
                    $('#editModal').modal('show');
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Melakukan update harga maupun subtotal jika terjadi perubahan pada input jumlah/harga/subtotal pada edit modal
        function editUpdateHarga() {
            var quantity = parseFloat(document.getElementById('edit_jumlah_barang').value);
            var price = parseFloat(document.getElementById('edit_harga_per_barang').value);
            var subtotal = parseFloat(document.getElementById('edit_harga_total').value);

            if (event.target.id === 'edit_jumlah_barang') {
                document.getElementById('edit_harga_total').value = quantity * price;
            }

            if (event.target.id === 'edit_harga_per_barang') {
                document.getElementById('edit_harga_total').value = quantity * price;
            }

            if (event.target.id === 'edit_harga_total') {
                document.getElementById('edit_harga_per_barang').value = price !== 0 ? subtotal / quantity : 0;
            }
        }

        // Function untuk memperbaruhi data yang diubah pada edit modal
        function updateArraySpesifikasiBarang(id, jumlah, harga, subtotal) {
            for (var i = 0; i < arraySpesifikasiJson.length; i++) {
                if (arraySpesifikasiJson[i].length > 0) {
                    for (var j = 0; j < arraySpesifikasiJson[i].length; j++) {
                        if (arraySpesifikasiJson[i][j].idbarang == id) {
                            arraySpesifikasiJson[i][j].jumlah = jumlah
                            arraySpesifikasiJson[i][j].harga = harga
                            arraySpesifikasiJson[i][j].subtotal = subtotal
                        }
                    }
                }
            }
        }

        // Event trigger untuk melakukan perubahan pada spesifikasi order
        function perbaruhiDataTabel(id) {
            var quantity = parseFloat(document.getElementById('edit_jumlah_barang').value);
            var price = parseFloat(document.getElementById('edit_harga_per_barang').value);
            var subtotal = parseFloat(document.getElementById('edit_harga_total').value);
            var stock = parseFloat(document.getElementById('stockupdate').innerHTML);
            if (quantity <= stock) {
                updateArraySpesifikasiBarang(id, quantity, price, subtotal);
                updateTabel();
                $('#editModal').modal('hide');
            } else {
                $('#editModal').modal('hide');
                alertUpdate("Stock Tidak Tersedia", "error")
            }

        }

        // Function untuk simpan ke database
        function insertDatabase() {
            var userData = @json(auth()->user());
            var selectElement = document.getElementById('client-name');
            var selectedIndex = selectElement.selectedIndex;
            var id_client = selectElement.options[selectedIndex].value;
            var selectJenisElement = document.getElementById('jenis-kegiatan');
            var selectedElementIndex = selectJenisElement.selectedIndex;
            var jenis_kegiatan = selectJenisElement.options[selectedElementIndex].value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('common.tambahevent2') }}",
                type: 'POST',
                data: {
                    'tanggal': document.getElementById('tanggal-acara').value,
                    'listbarang': arraySpesifikasiJson,
                    'id_event': document.getElementById('id-event').value
                },
                dataType: 'json',
                success: function(response) {
                    // Kalau success clear data
                    alertUpdate(response.msg, response.status)
                    if (response.status == "success") {
                        resetAll();
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Function untuk reset semua input
        function resetAll() {
            $(':input').val('');
            $('#kategori_barang option[disabled]').prop('selected', true)
            $('#nama_barang').empty();
            arraySpesifikasiJson = Object.values(@json($array_kategori));
            updateTabel();
        }

        //function otomatis on change tanggal acara
        function updateTanggal() {
            // Ambil nilai tanggal acara
            var tanggalAcara = new Date(document.getElementById('tanggal-acara').value);

            // Hitung tanggal loading in (tanggal acara - 10 jam)
            var tanggalLoadingIn = new Date(tanggalAcara);
            tanggalLoadingIn.setHours(tanggalAcara.getHours() - 10 + 7);
            document.getElementById('loading-in-date').value = tanggalLoadingIn.toISOString().slice(0, -8);

            // Tanggal acara mulai (sama dengan tanggal acara)
            document.getElementById('event-start-date').value = document.getElementById('tanggal-acara').value;

            // Tanggal acara selesai (tanggal acara + 8 jam)
            var tanggalAcaraSelesai = new Date(tanggalAcara);
            tanggalAcaraSelesai.setHours(tanggalAcara.getHours() + 8 + 7);
            document.getElementById('event-end-date').value = tanggalAcaraSelesai.toISOString().slice(0, -8);

            // Tanggal loading out (tanggal acara + 12 jam)
            var tanggalLoadingOut = new Date(tanggalAcara);
            tanggalLoadingOut.setHours(tanggalAcara.getHours() + 12 + 7);
            document.getElementById('loading-out-date').value = tanggalLoadingOut.toISOString().slice(0, -8);

            updateTanggalSelesai();
        }

        function updateDurasiAcara() {
            // Ambil nilai tanggal acara mulai dan tanggal acara selesai
            var tanggalMulai = new Date(document.getElementById('event-start-date').value);
            var tanggalSelesai = new Date(document.getElementById('event-end-date').value);

            // Hitung durasi acara (tanggal acara selesai - tanggal acara mulai)
            var durasiAcara = (tanggalSelesai - tanggalMulai) / (1000 * 60 * 60); // hasil dalam jam

            // Tampilkan durasi acara di label tanggal acara selesai
            document.getElementById('event-end-date').nextElementSibling.innerHTML = 'Durasi Acara : ' + durasiAcara +
                ' jam';
        }

        function updateTanggalSelesai() {
            // Ambil nilai tanggal acara selesai
            var tanggalAcaraSelesai = new Date(document.getElementById('event-end-date').value);

            // Tanggal loading out (tanggal acara selesai + 4 jam)
            var tanggalLoadingOut = new Date(tanggalAcaraSelesai);
            tanggalLoadingOut.setHours(tanggalAcaraSelesai.getHours() + 4 + 7);
            document.getElementById('loading-out-date').value = tanggalLoadingOut.toISOString().slice(0, -8);

            // Hitung dan update durasi acara
            updateDurasiAcara();
        }
    </script>
@endsection
