@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('template/assets/css/dashboard.css') }}" />
@endsection

@section('content')
    {{-- isinya kyk summary dari masing masing contoh persentase / jumlah transaksi total / penghasilan dsbnya --}}
    <section id="basic-horizontal-layouts">
      <div class="row">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Dashboard</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                      <!-- Tanggal Beli -->
                      <div class="col-12">
                          <div class="mb-1 row">
                              <div class="col-sm-3">
                                  <label class="col-form-label" for="tanggal-beli">Tanggal</label>
                              </div>
                              <div class="col-sm-3">
                                  <input type="month" id="tanggal" class="form-control" name="tanggal-beli" value="" onchange="changeDate()" />
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
                                  <label class="col-form-label" for="tanggal-beli">Omzet Bulan Ini</label>
                              </div>
                              <div class="col-sm-3">
                                  <p class="col-form-label" id="omzet">{{ $data['omzet'] }}</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="mb-1 row">
                              <div class="col-sm-3">
                                  <label class="col-form-label" for="tanggal-beli">Jumlah Event Selesai/Batal</label>
                              </div>
                          </div>
                          <div class="mb-1 row">
                            <canvas id="myChart" style="width:100%;max-width:600px; margin: auto;"></canvas>
                          </div>
                      </div>
                      <div class="card-body h5 text-dark">
                        <table class="table caption-top table-bordered table-striped table-hover table-responsive"
                            id="listevent">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Lokasi</th>
                                    <th>Budget</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['list_events'] as $event)
                                    @csrf
                                    <tr id="tr_{{ $event['id'] }}">
                                        <td></td>
                                        <td id="td_tanggal_{{ $event['id'] }}">{{ $event['tanggal'] }}</td>
                                        <td id="td_nama_{{ $event['id'] }}">{{ $event['nama'] }}</td>
                                        <td id="td_status_{{ $event['id'] }}">{{ $event['status'] }}</td>
                                        <td id="td_lokasi_{{ $event['id'] }}">{{ $event['lokasi'] }}</td>
                                        <td id="td_budget_{{ $event['id'] }}">{{ $event['budget'] }}</td>
                                        <td id="td_kategori_{{ $event['id'] }}">{{ $event['kategori'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Lokasi</th>
                                    <th>Budget</th>
                                    <th>Kategori</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </section>

    <div class="square">
        <div class="menu-container">
            <div class="menu-row">
                <a class="menu-item" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">Data Pelanggan</span>
                </a>
                <a class="menu-item" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-timeline"></i>
                    </span>
                    <span class="hide-menu">Transaksi Penjualan</span>
                </a>
            </div>
            <div class="menu-row">
                <a class="menu-item" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                      <i class="ti ti-report-analytics"></i>
                    </span>
                    <span class="hide-menu">Laporan Penjualan</span>
                </a>  
                <a class="menu-item" href="" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-plus"></i>
                    </span>
                    <span class="hide-menu">Tambah Order</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    {{-- <script>
      // function updatePie() {
      //   let datas = {!! json_encode($data->selesai_batal); !!};
      //   var xValues = [];
      //   var yValues = [];
      //   var barColors = [];
      //   datas.forEach(data => {
      //     xValues.push(data['berhasil_tidak']);
      //     yValues.push(data['jumlah']);
      //     if (data['berhasil_tidak'] == 'berhasil') {
      //       barColors.push('#03258C')
      //     } else {
      //       barColors.push('#ff9cee')
      //     }
      //   });
          
      //   new Chart("myChart", {
      //     type: "pie",
      //     data: {
      //       labels: xValues,
      //       datasets: [{
      //         backgroundColor: barColors,
      //         data: yValues
      //       }]
      //     },
      //     options: {
      //       title: {
      //         display: true,
      //         text: "Jumlah Event Selesai/Batal"
      //       }
      //     }
      //   });
      // }
      // updatePie();
    </script> --}}
    <script>
      document.getElementById('tanggal').valueAsDate = new Date();
      $(document).ready(function() {
          var table = $('#listevent').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
          } );
  
          table.buttons().container()
              .appendTo( '#listevent_wrapper .col-md-6:eq(0)' );
          });
      function changeDate() {
        table.clear();
        dateValue = document.getElementById('tanggal').value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.indexParameter') }}",
            type: 'POST',
            data: {
                'date': dateValue,
            },
            dataType: 'json',
            success: function(response) {
                document.getElementById('jumlahEvent').innerHTML = response.data.jumlah_event;
                document.getElementById('omzet').innerHTML = response.data.omzet;
                // updatePie();
                response.data.list_events.forEach(event => {
                  table.row.add([
                    event.tanggal,
                    event.nama,
                    event.status,
                    event.lokasi,
                    event.budget,
                    event.kategori
                  ]).draw();
                });
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
      }
    </script>
@endsection