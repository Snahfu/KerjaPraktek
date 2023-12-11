@extends('layouts.app')

@section('title')
    Dashboard Gudang
@endsection

@section('css')
    <style>
        .bg-danger {
            background-color: red !important;
        }
    </style>
@endsection

@section('content')
    <h1>Tugas</h1>
    <ul class="list-group">
        <ol class="list-group list-group-numbered">
            @foreach ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-start" id="task-{{ $task->id }}">
                <div class="ms-2 me-auto col-sm-9">
                    <div>
                        <span style="font-weight: 900">{{ $task->judul }}</span> ({{ $task->mulai }})
                        @if ($task->warna == '#00ff00')
                            <span class="fw-bolder badge bg-success">Meeting</span>
                        @elseif ($task->warna == '#0000ff')
                            <span class="fw-bolder badge bg-primary">Event</span>
                        @else
                            <span class="fw-bolder badge bg-danger">Tagihan</span>
                        @endif
                    </div>
                    <p class="text-break">{{ $task->deskripsi }}</p>
                </div>
                <button class="badge bg-danger rounded-pill " onclick="alert('Apakah ingin menghapus task ini?'); doneTask({{ $task->id }})">X</button>
            </li>
            @endforeach
        </ol>
    </ul>
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

        function doneTask(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('checktask') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': id,
                },
                success: function(response) {
                    alertUpdate(response.msg, response.status)
                    task = document.getElementById(`task-${id}`);
                    task.remove();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }
    </script>
@endsection
