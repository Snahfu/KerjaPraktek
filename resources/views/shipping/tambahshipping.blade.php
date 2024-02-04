@extends('layouts.app')

@section('title')
    Tambah Shipping Page
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Form Input Data Shipping</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Nama Event -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="event">Event</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="event" onchange="updateBarang()">
                                        @foreach ($event as $e)
                                            <option value="{{$e->id}}">{{$e->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Event -->
                        <div class="col-12">
                          <div class="mb-1 row">
                              <div class="col-sm-3">
                                  <label class="col-form-label" for="event">Tanggal Event</label>
                              </div>
                              <div class="col-sm-9">
                                <input type="datetime-local" disabled id="tanggalEvent" class="form-control"/>
                              </div>
                          </div>
                        </div>

                        <!-- Venus Event -->
                        <div class="col-12">
                          <div class="mb-1 row">
                              <div class="col-sm-3">
                                  <label class="col-form-label" for="event">Venue Event</label>
                              </div>
                              <div class="col-sm-9">
                                <input type="text" disabled id="venueEvent" class="form-control"/>
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
                                        <option value="Kirim">Kirim</option>
                                        <option value="Jemput">Jemput</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tgl-jalan">Waktu Pengiriman</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" id="tgl-jalan" class="form-control"
                                        name="tgl-jalan" onchange="checkDriver()" />
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
                                    <select class="form-select" id="driver" onchange="checkDriver()">
                                        @foreach ($karyawan as $k)
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="notes">Notes</label>
                                </div>
                                <div class="col-sm-9">
                                  <input type="text" id="notes" class="form-control"
                                  name="notes" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 id="forNothing"></h2>

        {{-- <div class="row detail-barang" id="spek">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Spesifikasi Barang Shipping</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="barang">Jenis Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="barang" onchange="updateQuantity()" disabled>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="quantity">Quantity</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" value="1" min="1" id="quantity"
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-1" onclick="tambahSpesifikasi()">Add</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
    <!-- Basic Horizontal form layout section end -->

    <div class="row detail-barang" id="tabel-barang">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header border-bottom custom-header-color" id="headerCheckBox">
                  <h4 class="card-title" style="float: left;">Table Detail Barang</h4>
                </div>
                <div class="card-body h5 text-dark">
                    <table class="table caption-top table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Barang</th>
                                <th>Quantity</th>
                                {{-- <th>Edit</th> --}}
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

    <button type="submit" class="btn btn-primary me-1 detail-barang" onclick="insertDatabase()">Submit</button>
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
                  <form action="{{ route('shipping.datashipping') }}">
                    <button id="alertModalButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
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
        // Array untuk menyimpan data list barang pada setiap jenis barang
        var arrayBarang;
        // Maping untuk menampilkan nama jenis pada comboboxnya
        var jenis_map = @json($jenis_map);

        $(document).ready(function() {
            updateBarang();
        });

        // Function untuk alert Message
        function alertUpdate(msg, status) {
            var alertModalTitle = document.getElementById('alertModalTitle');
            var alertModalButton = document.getElementById('alertModalButton');
            if (status == "success") {
                alertModalTitle.classList.remove('bg-danger');
                alertModalTitle.classList.add('bg-success');
                alertModalButton.type = "submit";
                $('#responseController').html(msg);
                $('#alertModal').modal('show');
            } else {
                alertModalTitle.classList.remove('bg-success');
                alertModalTitle.classList.add('bg-danger');
                alertModalTitle.type = "button";
                $('#responseController').html(msg);
                $('#alertModal').modal('show');
            }
        }

        function toggleAllCheckboxes() {
          var checkboxes = document.querySelectorAll('[id^="chckbx"]');
          var selectAllCheckbox = document.getElementById('selectAll');

          checkboxes.forEach(function (checkbox) {
              checkbox.checked = selectAllCheckbox.checked;
          });
        }

        // Menghapus semua option pada selectElement
        function hapusOptionPadaSelect(selectElement) {
            while (selectElement.options.length > 0) {
                selectElement.remove(0);
            }
        }

        // Melakukan pengecekan apakah driver yang bersangkutan kosong pada 2 jam sebelum dan setelah waktu dan driver yang dipilih
        function checkDriver() {
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('checkdriver') }}",
                type: 'POST',
                data: {
                    'driver': parseInt(document.getElementById('driver').value),
                    'tglJalan': document.getElementById('tgl-jalan').value,
                    'tglEvent': document.getElementById('tanggalEvent').value,
                },
                dataType: 'json',
                success: function(response) {
                    if(response.status != "success"){
                        alertUpdate(response.msg, response.status)
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Melakukan update barang pada comboBox nama-barang
        function updateBarang() {
            arraySpesifikasiJson = Object.values(@json($array_jenis));
            var idEvent = document.getElementById('event').value;
            var jenis = document.getElementById('jenis').value;
            var events = {!! json_encode($event) !!};
            document.getElementById('tanggalEvent').value = "";
            document.getElementById('venueEvent').value = "";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('getbarangshipping') }}",
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
                        hasilFilterEvent = events.filter((e) => e.id == idEvent);
                        let tanggalEvent = hasilFilterEvent[0].tanggal;
                        document.getElementById('tanggalEvent').value = tanggalEvent;
                        document.getElementById('venueEvent').value = hasilFilterEvent[0].lokasi;

                        if (jenis == "Kirim") {
                          let tanggalEventMili = new Date(tanggalEvent);
                          tanggalKirim = new Date(tanggalEventMili - (10*60*60*1000));
                        } else if (jenis == "Jemput") {
                          tanggalEvent = hasilFilterEvent[0].waktu_loading_out;
                          let tanggalEventMili = new Date(tanggalEvent);
                          tanggalKirim = tanggalEventMili;
                        }

                        const year = tanggalKirim.getFullYear();
                        const month = String(tanggalKirim.getMonth()+1).padStart(2, '0');
                        const date = String(tanggalKirim.getDate()).padStart(2, '0');
                        const hour = String(tanggalKirim.getHours()).padStart(2, '0');
                        const minute = String(tanggalKirim.getMinutes()).padStart(2, '0');
                        const second = String(tanggalKirim.getSeconds()).padStart(2, '0');

                        tanggalKirimDateTime = year + "-" + month + "-" + date + "T" + hour + ":" + minute + ":" + second;
                        document.getElementById('tgl-jalan').value = tanggalKirimDateTime;
                        let spek = document.getElementById('spek');
                        let elementShow = document.getElementsByClassName('detail-barang');

                        if(jenis === "Kirim") {
                            // spek.style.display = '';
                            // console.log(Object.keys(response.datas).length);


                            if(Object.keys(response.datas).length === 0) {
                              // console.log("masuk");
                                for (var i = 0; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = 'none';
                                }

                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "Tidak ada barang untuk dikirim";
                            } else {
                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "";

                                for (var i = 0; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = '';
                                }
                                // namaBarangElement = document.getElementById("barang")
                                // namaBarangElement.disabled = false;
                                // hapusOptionPadaSelect(namaBarangElement);
        
                                // var optionSelected = document.createElement('option');
                                // optionSelected.value = 'x~~'+ 0;
                                // optionSelected.text = "-- Pilih ID Barang --";
                                // optionSelected.disabled = true;
                                // optionSelected.selected = true;
                                // namaBarangElement.add(optionSelected);
        
                                for (var data in response.datas) {
                                    // if (response.datas[data].type_barang == "batch") {
                                    //   var option = document.createElement('option');
                                    //   option.value = response.datas[data].qty + '~~' + response.datas[data].idjenis + '~~' + response.datas[data].jenis + '~~' +  response.datas[data].type_barang,
                                    //   option.text = response.datas[data].jenis;
                                    //   namaBarangElement.add(option);
                                    // }

                                    // Isi tabel detail barang
                                    var spesifikasiBarang = {
                                        idbarang: 0,
                                        idjenis: response.datas[data].idjenis,
                                        jenis: response.datas[data].jenis,
                                        quantity: response.datas[data].qty,
                                        list_barang: response.datas[data].list_barang,
                                        type_barang: response.datas[data].type_barang,
                                    }

                                    arraySpesifikasiJson[response.datas[data].idjenis].push(spesifikasiBarang);
                                }
                                updateTabel();
                            }
                        } else {
                            // spek.style.display = 'none';

                            console.log(Object.keys(response.datas).length);
                            if(Object.keys(response.datas).length === 0) {
                                for (var i = 0; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = 'none';
                                }

                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "Tidak ada barang untuk dijemput";
                            } else {
                                document.getElementById('tabel-barang').style.display = '';
                                for (var i = 1; i < elementShow.length; i ++) {
                                    elementShow[i].style.display = '';
                                }

                                var h2 = document.getElementById('forNothing');
                                h2.textContent = "";

                                for (var data in response.datas) {
                                    // Isi tabel detail barang
                                    var spesifikasiBarang = {
                                        idbarang: 0,
                                        idjenis: response.datas[data].idjenis,
                                        jenis: response.datas[data].jenis,
                                        quantity: response.datas[data].qty,
                                        list_barang: response.datas[data].list_barang,
                                        type_barang: response.datas[data].type_barang,
                                    }
    
                                        arraySpesifikasiJson[response.datas[data].idjenis].push(spesifikasiBarang);
                                }
                                updateTabel();
                                // $('#barang_' + i + "_" + j).find('td');
                                $("#headerCheckBox").append(`
                                  <div class="text-end" style="float: right">
                                    <input type="checkbox" id="selectAll" onclick="toggleAllCheckboxes()">
                                    <label class="text-white card-title" for="selectAll">&nbspSelect All
                                    </label>
                                  </div>`)
                            }
                        }
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function updateQuantity() {
            var barangElement = document.getElementById('barang');
            var barangIndex = barangElement.selectedIndex;
            var idAndJenis = barangElement.options[barangIndex].value.split("~~");
            var qty = idAndJenis[0];

            $("#quantity").attr({
                "max" : qty,
                "min" : 1
            });
        }

        // Menambahkan data spesifikasi barang ke dalam tabel
        function tambahSpesifikasi() {
            var barangElement = document.getElementById('barang');
            var barangIndex = barangElement.selectedIndex;
            var idAndJenis = barangElement.options[barangIndex].value.split("~~");
            var idJenis = idAndJenis[1];
            var jenis = idAndJenis[2];
            var type_barang = idAndJenis[3];
            
            if(idJenis == 0) {
                $('#alertModal').modal('show');
                alertModalTitle.classList.remove('bg-success');
                alertModalTitle.classList.add('bg-danger');
                $('#responseController').text("Pilih ID barang terlebih dahulu!");

                return
            }

            var quantity = parseInt(document.getElementById('quantity').value);

            var listBarang;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('getlistbarangshipping') }}",
                type: 'POST',
                data: {
                    'idJenis': idJenis,
                },
                dataType: 'json',
                success: function(response) {
                    if(response.status == "success"){
                      listBarang = response.datas;
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });

            var spesifikasiBarang = {
                idbarang: 0,
                idjenis: idJenis,
                jenis: jenis,
                quantity: quantity,
                list_barang: listBarang,
                type_barang: type_barang,
            }

            arraySpesifikasiJson[idJenis].push(spesifikasiBarang);
            updateTabel();
        }

        // Melakukan update UI pada tabel agar sesuai dengan tampilannya
        function updateTabel() {
            var stringHTML = ``;
            var stringCheckboxBarang = ``;
            var stringQuantityBarang = ``;
            console.log(arraySpesifikasiJson);
            for (var i = 0; i < arraySpesifikasiJson.length; i++) {
              if (arraySpesifikasiJson[i].length > 0) {
                    stringHTML += `<tr><td colspan="2">${jenis_map[i]}</td><td colspan="1">Quantity: ${arraySpesifikasiJson[i][0].quantity}</td></tr>`
                    for (var j = 0; j < arraySpesifikasiJson[i].length; j++) {
                        listBarang = arraySpesifikasiJson[i][j].list_barang;
                        var k = 0;
                        listBarang.forEach(barang => {
                          stringCheckboxBarang = "";
                          stringQuantityBarang = "";
                          if (arraySpesifikasiJson[i][j].type_barang == "serial") {
                              // $('#spek').css('display','none')
                              stringCheckboxBarang += 
                              `
                              <input type="checkbox" id="chckbx${barang.id}" name="chckbx${barang.id}" value="${barang.id}">
                              <label for="chckbx${barang.id}">${barang.nama} </label>
                              `
                              stringQuantityBarang +=
                              `
                              <input type="number" value="1" disabled id="edit_quantity_barang_${arraySpesifikasiJson[i][j].idjenis}" class="form-control"/>
                              `
                              stringHTML +=
                                `
                                <tr id='barang_${i}_${k}'>
                                    <td></td>
                                    <td class="col-sm-6">
                                      ${stringCheckboxBarang}
                                    </td>
                                    <td class="col-sm-3">
                                      ${stringQuantityBarang}
                                    </td>
                                    <td class="text-center">
                                        <button disabled type="button" class="btn btn-danger" onclick="hapusDataTabel(${i},${j})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                `
                              k += 1;
                          } else {
                              // $('#spek').css('display','')
                              stringCheckboxBarang += 
                              `
                              ${barang.nama}
                              `
                              stringQuantityBarang +=
                              `
                              <input type="number" value="1" max="${arraySpesifikasiJson[i][j].quantity}" min="1" id="edit_quantity_barang_${arraySpesifikasiJson[i][j].idjenis}" class="form-control"/>
                              <input type="hidden" value="${barang.id}" >
                              `
                              stringHTML +=
                                `
                                <tr id='barang_${i}_${k}'>
                                    <td></td>
                                    <td class="col-sm-6">
                                      ${stringCheckboxBarang}
                                    </td>
                                    <td class="col-sm-3">
                                      ${stringQuantityBarang}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger" onclick="hapusDataTabel(${i},${j})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                `
                              k += 1;
                            }
                            
                                // console.log(arraySpesifikasiJson[i][j].idbarang);
                        });
                    }
                }
                document.getElementById('data_table').innerHTML = stringHTML;
            }
        }

        // Menghapus data tabel baik tampilan maupun pada arraySpesifikasiOrder
        function hapusDataTabel(i,j) {
            var iBarangToDelete = parseInt(i);
            var jBarangToDelete = parseInt(j);
            for (var key in arraySpesifikasiJson) {
              if (arraySpesifikasiJson.hasOwnProperty(key)) {
                for (var k in arraySpesifikasiJson[key]) {
                  if (key.hasOwnProperty(k)) {
                    arraySpesifikasiJson[i] = arraySpesifikasiJson[i].filter(function(obj) {
                        return k != j;
                    });
                  }
                }
              }
            }
            // for (var key in arraySpesifikasiJson) {
            //     if (arraySpesifikasiJson.hasOwnProperty(key)) {
            //         arraySpesifikasiJson[key] = arraySpesifikasiJson[key].filter(function(obj) {
            //             return obj.idbarang != idBarangToDelete;
            //         });
            //     }
            // }
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
        function insertDatabase() {
          var listBarang = [];
          console.log(arraySpesifikasiJson);
            for (var i = 0; i < arraySpesifikasiJson.length; i++) {
              var totalQuantity = 0;
              if (arraySpesifikasiJson[i].length > 0) {
                    var requiredQuantity = arraySpesifikasiJson[i][0].quantity;
                    for (var j = 0; j < arraySpesifikasiJson[i][0].list_barang.length; j++) {
                        var tdList = $('#barang_' + i + "_" + j).find('td');
                        // console.log(tdList);
                        console.log(tdList);
                        if (arraySpesifikasiJson[i][0].type_barang == "serial") {
                          var isChecked = tdList[1].children[0].checked;
                          var listIdBarangNotChecked = [];
                          
                          if (isChecked) {
                            // console.log(tdList[1].children[0].value);
                            var idBarang = tdList[1].children[0].value;
                            var quantity = tdList[2].children[0].value;
                            
                            listBarang.push({idbarang: idBarang, quantity: quantity});

                            
                            totalQuantity += parseInt(quantity);

                            // listBarang[i][j] = {quantity: quantity};

                            // listIdBarangNotChecked.push(idbarang);

                          }
                          // arraySpesifikasiJson[i] = arraySpesifikasiJson[i].filter(function(obj) {
                              // return arraySpesifikasiJson[i][j].idbarang != ;
                          // });
                        } else if (arraySpesifikasiJson[i][0].type_barang == "batch"){
                          var idBarang = tdList[2].children[1].value;
                          var quantity = tdList[2].children[0].value;
                          if (quantity > 0) {
                            // listBarang.push({idbarang: idBarang, quantity: quantity});
                            if (parseInt(quantity) <= arraySpesifikasiJson[i][0].quantity) {
                              listBarang.push({
                                  idbarang: idBarang,
                                  quantity: quantity
                              });
                            } else {
                              alertUpdate('Total kuantitas untuk ' + jenis_map[i] + ' melebihi dari kuantitas yang dibutuhkan ('+ parseInt(quantity) + '/' + arraySpesifikasiJson[i][0].quantity + ') (Terpilih/Kebutuhan).', 'Failed');
                              jenis_map[i]
                              return;
                            }
                          }
                        }

                        if (totalQuantity > requiredQuantity) {
                          alertUpdate('Total kuantitas untuk ' + jenis_map[i] + ' melebihi dari kuantitas yang dibutuhkan ('+ totalQuantity + '/' + requiredQuantity + ') (Terpilih/Kebutuhan).', 'Failed');
                          return; // Stop further processing
                        }
                        // var tdList = $('#barang_' + i + "_" + j).find('td');
                        // var idBarang = tdList[1].children[0].value;
                        // var quantity = tdList[2].children[0].value;
                        // arraySpesifikasiJson[i][j].idbarang = idBarang;
                        // arraySpesifikasiJson[i][j].quantity = quantity;
                    }
                }
            }
            console.log(listBarang)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('storeshipping') }}",
                type: 'POST',
                data: {
                    'events_id': parseInt(document.getElementById('event').value),
                    'jenis': document.getElementById('jenis').value,
                    'driver': parseInt(document.getElementById('driver').value),
                    'tglJalan': document.getElementById('tgl-jalan').value,
                    'notes': document.getElementById('notes').value,
                    'listbarang': listBarang,
                },
                dataType: 'json',
                success: function(response) {
                    alertUpdate(response.msg, response.status);
                    if(response.status == "success"){
                    }
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
            $('#barang option[disabled]').prop('selected', true)
            $('#barang').empty();
            updateBarang();
            arraySpesifikasiJson = Object.values(@json($array_jenis));
            updateTabel();
        }
    </script>
@endsection
