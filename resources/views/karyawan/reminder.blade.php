@extends('layouts.app')

@section('title')
    Jadwal Kerja dan Reminder
@endsection

@section('content')
    <div id='calendar-container'>
        <div id='calendar'></div>
    </div>

    <button class="btn btn-success mt-3" id="tambahData">Tambah Data</button>
    {{-- Modal Tambah Begin --}}
    <div class="modal fade" id="configmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="configmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="configmodalLabel">Tambah Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputJudulCalendar" class="form-label">Judul Aktivitas</label>
                        <input type="text" class="form-control" id="inputJudulCalendar" placeholder="Judul Aktivitas">
                    </div>
                    <div class="mb-3">
                        <label for="inputDeskripsiCalendar" class="form-label">Deskripsi Aktivitas</label>
                        <textarea class="form-control" id="inputDeskripsiCalendar" rows="4" placeholder="Jelaskan Aktivitas"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="inputMulaiCalendar" class="form-label">Mulai</label>
                        <input type="datetime-local" class="form-control" id="inputMulaiCalendar">
                    </div>
                    <div class="mb-3">
                        <label for="inputSelesaiCalendar" class="form-label">Selasai</label>
                        <input type="datetime-local" class="form-control" id="inputSelesaiCalendar">
                    </div>
                    <div class="mb-3">
                        <label for="inputColor" class="form-label">Kategori Kegiatan</label>
                        <select class="form-select" id="inputColor">
                            @foreach ($colors as $key => $color)
                                <option value="{{ $key }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="tambahButton" onclick="tambahAcara()">Tambah</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Tambah End --}}

    {{-- Modal Edit & Delete Begin --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Detail Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editJudulCalendar" class="form-label">Judul Aktivitas</label>
                        <input type="text" class="form-control" id="editJudulCalendar" placeholder="Judul Aktivitas">
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsiCalendar" class="form-label">Deskripsi Aktivitas</label>
                        <textarea class="form-control" id="editDeskripsiCalendar" rows="4" placeholder="Jelaskan Aktivitas"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editMulaiCalendar" class="form-label">Mulai</label>
                        <input type="datetime-local" class="form-control" id="editMulaiCalendar">
                    </div>
                    <div class="mb-3">
                        <label for="editSelesaiCalendar" class="form-label">Selasai</label>
                        <input type="datetime-local" class="form-control" id="editSelesaiCalendar">
                    </div>
                    <div class="mb-3">
                        <label for="editColor" class="form-label">Kategori Kegiatan</label>
                        <select class="form-select" id="editColor">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="buttonPerbaruhi"
                        onclick="updateAcara()">Perbaruhi</button>
                    <button type="button" class="btn btn-danger" id="buttonHapus"
                        onclick="deleteAcara()">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit & Delete End --}}

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
                    <button id="alertModalButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Alert End --}}
@endsection

@section('javascript')
    <script>
        var calendar;
        var listColor = @json($colors);

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var semua_agenda = @json($semua_agenda);
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                editable: true,
                nextDayThreshold: '00:00:00',
                events: semua_agenda,
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: false
                },
                eventClick: function(detail) {
                    var agendaId = detail.event.id;
                    getAgendaData(agendaId);
                    $('#editModal').modal('show');
                }
            });
            calendar.render();
        });

        function datetimeLocal(datetime) {
            const dt = new Date(datetime);
            dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
            return dt.toISOString().slice(0, 16);
        }

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

        document.getElementById('tambahData').addEventListener('click', function() {
            $('#configmodal').modal('show');
        });

        function hapusOptionPadaSelect(selectElement) {
            while (selectElement.options.length > 0) {
                selectElement.remove(0);
            }
        }

        function getAgendaData(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('karyawan.detailagenda') }}",
                type: 'POST',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    document.getElementById('editJudulCalendar').value = response.data.judul;
                    document.getElementById('editDeskripsiCalendar').value = response.data.deskripsi;
                    document.getElementById("editMulaiCalendar").value = datetimeLocal(response.data.mulai);
                    document.getElementById("editSelesaiCalendar").value = datetimeLocal(response.data.selesai);

                    editColorElement = document.getElementById("editColor")
                    hapusOptionPadaSelect(editColorElement);
                    var option = document.createElement('option');
                    option.value = response.data.warna;
                    option.text = listColor[response.data.warna];
                    editColorElement.add(option);
                    for (var key in listColor) {
                        if (key != response.data.warna) {
                            var option = document.createElement('option');
                            option.value = key;
                            option.text = listColor[key];
                            editColorElement.add(option);
                        }
                    }

                    $('#buttonPerbaruhi').attr('onclick', 'updateAgenda(' + id + ')');
                    $('#buttonHapus').attr('onclick', 'deleteAgenda(' + id + ')');
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // CRUD Calendar
        function tambahAcara() {
            var selectElement = document.getElementById('inputColor');
            var selectedIndex = selectElement.selectedIndex;
            var selectedKey = selectElement.options[selectedIndex].value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('karyawan.tambahagenda') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'judul': document.getElementById('inputJudulCalendar').value,
                    'deskripsi': document.getElementById('inputDeskripsiCalendar').value,
                    'mulai': document.getElementById('inputMulaiCalendar').value,
                    'selesai': document.getElementById('inputSelesaiCalendar').value,
                    'warna': selectedKey,
                },
                success: function(response) {
                    var id = response.data;
                    var judul = document.getElementById('inputJudulCalendar').value;
                    var deskripsi = document.getElementById('inputDeskripsiCalendar').value;
                    var mulai = document.getElementById('inputMulaiCalendar').value;
                    var selesai = document.getElementById('inputSelesaiCalendar').value;

                    var event = {
                        title: judul,
                        start: mulai,
                        end: selesai,
                        description: deskripsi,
                        id: id,
                        backgroundColor: selectedKey,
                    };

                    calendar.addEvent(event);
                    $('#configmodal').modal('hide');

                    alertUpdate(response.msg, response.status);
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function updateAgenda(id) {
            var selectElement = document.getElementById('editColor');
            var selectedIndex = selectElement.selectedIndex;
            var selectedKey = selectElement.options[selectedIndex].value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('karyawan.updateagenda') }}",
                type: 'POST',
                data: {
                    'id': id,
                    'judul': document.getElementById('editJudulCalendar').value,
                    'deskripsi': document.getElementById('editDeskripsiCalendar').value,
                    'mulai': document.getElementById('editMulaiCalendar').value,
                    'selesai': document.getElementById('editSelesaiCalendar').value,
                    'warna': selectedKey,
                },
                dataType: 'json',
                success: function(response) {
                    $('#editModal').modal('hide');
                    alertUpdate(response.msg, response.status);
                    calendar.refetchEvents()
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function deleteAgenda(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('karyawan.deleteagenda') }}",
                type: 'POST',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    $('#editModal').modal('hide');
                    alertUpdate(response.msg, response.status);
                    calendar.refetchEvents()
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }
    </script>
@endsection
