@extends('layouts.app')

@section('title')
    Edit Data Kerusakan Barang
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Form Edit Data Kerusakan Barang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{ $itemDamage->id }}">
                        <!-- Barang -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="barang">ID Barang</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="barang">
                                        @foreach ($barang as $b)
                                            @if ($itemDamage->item_barang_id == $b->id)
                                                <option value="{{$b->id}}" selected>{{$b->id}} - {{ $b->jenis->nama }}</option>
                                            @else
                                                <option value="{{$b->id}}">{{$b->id}} - {{ $b->jenis->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Damage Date -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="damage-date">Tanggal Rusak</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" id="damage-date" class="form-control" name="damage-date" value="{{ $itemDamage->damage_date }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Damage Type -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="damage-type">Jenis Kerusakan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="damage-type" class="form-control" name="damage-type" placeholder="Jenis Kerusakan" value="{{ $itemDamage->damage_type }}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Damage Detail -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="damage-detail">Detail Kerusakan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="damage-detail" class="form-control" name="damage-detail" placeholder="Detail Kerusakan" value="{{ $itemDamage->damage_details }}" />
                                </div>
                            </div>
                        </div>

                        <!-- User Servicer -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="user-servicer">Bagian Servis</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" id="user-servicer">
                                        @foreach ($karyawan as $k)
                                            @if ($itemDamage->user_servicer == $k->id)
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
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->

    <button type="submit" class="btn btn-primary me-1" onclick="updateDatabase()">Submit</button>
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
                  <form action="{{ route('damage.datadamage') }}">
                    <button id="alertModalButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Alert End --}}
@endsection

@section('javascript')
    <script>
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

        // Function untuk simpan ke database
        function updateDatabase() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('updatedamage') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': parseInt(document.getElementById('id').value),
                    'item_barang_id': parseInt(document.getElementById('barang').value),
                    'damage_date': document.getElementById('damage-date').value,
                    'damage_type': document.getElementById('damage-type').value,
                    'damage_details': document.getElementById('damage-detail').value,
                    'user_servicer': parseInt(document.getElementById('user-servicer').value),
                },
                success: function(response) {
                    alertUpdate(response.msg, response.status);
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        // Function untuk reset semua input
        function resetAll(){
            $(':input').val('');
        }
    </script>
@endsection
