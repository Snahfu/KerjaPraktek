@extends('layouts.app')

@section('content')
    {{-- isinya kyk summary dari masing masing contoh persentase / jumlah transaksi total / penghasilan dsbnya --}}
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Tanggal Laporan -->
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tanggal-laporan">Tanggal</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="month" id="tanggal" class="form-control" name="tanggal-beli"
                                        value="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tanggal-beli">Jumlah Event Bulan Ini</label>
                                </div>
                                <div class="col-sm-3">
                                    <p class="col-form-label" id="jumlahEvent">{{ $data['jumlah_event'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tanggal-beli">Jumlah Barang Rusak Bulan Ini</label>
                                </div>
                                <div class="col-sm-3">
                                    <p class="col-form-label" id="rusak">{{ $data['jumlah_rusak'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        document.getElementById('tanggal').valueAsDate = new Date();

        $('#tanggal').on('change', function() {
            dateValue = document.getElementById('tanggal').value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('gudang.dashboard.parameter') }}",
                type: 'POST',
                data: {
                    'date': dateValue,
                },
                dataType: 'json',
                success: function(response) {
                    document.getElementById('jumlahEvent').innerHTML = response.data.jumlah_event;
                    document.getElementById('rusak').innerHTML = response.data.jumlah_rusak;
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
    </script>
@endsection
