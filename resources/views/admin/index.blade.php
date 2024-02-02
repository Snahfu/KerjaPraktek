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
                                  <input type="month" id="tanggal" class="form-control" name="tanggal-beli" value="" />
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
                                  <p class="col-form-label" id="omzet">@currency($data['omzet'])</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="mb-1 row">
                              <div class="col-sm-3">
                                  <label class="col-form-label" for="tanggal-beli">Status Event Bulan Ini</label>
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
                                    <th>No</th>
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
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $event['tanggal'] }}</td>
                                        <td>{{ $event['nama'] }}</td>
                                        <td>{{ $event['status'] }}</td>
                                        <td>{{ $event['lokasi'] }}</td>
                                        <td>{{ $event['budget'] }}</td>
                                        <td>{{ $event['kategori'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
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

    {{-- <div class="square">
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
    </div> --}}
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
      let myChart;
      function updatePie(data) {
        let datas = data;
        // alert(datas);
        let xValues = [];
        let yValues = [];
        let barColors = [];
        // alert(datas[1]);
        datas.forEach(data => {
          xValues.push(data['status']);
          yValues.push(data['total']);
          
          // var color = '#';
          // for (let i = 0; i < 6; i++) {
          //   const listChar = '0123456789abcdef'
          //   const angka = Math.floor(Math.random() * 16);
          //   const char = listChar[angka];
          //   color += char;
          // }

          let color = "";
          switch (data['status']) {
            case "Diproses":
              color = "#000000";
              break;
            case "Diterima":
              color = "#222222";
              break;
            case "Draft":
              color = "#444444";
              break;
            case "Event Berlangsung":
              color = "#666666";
              break;
            case "Menunggu Persetujuan":
              color = "#888888";
              break;
            case "Selesai":
              color = "#aaaaaa";
              break;
            case "Tagihan":
              color = "#cccccc";
              break;
          }
            
          barColors.push(color);
        });
          
        myChart = new Chart("myChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {display: false},
            title: {
              display: true,
              text: "Status Event Bulan Ini"
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  precision: 0
                }
              }]
            }
          }
        });
      }
      updatePie({!! json_encode($data['status_events']); !!});
    </script>
    <script>
      document.getElementById('tanggal').valueAsDate = new Date();
      let table = $('#listevent').DataTable( {
      lengthChange: false,
      buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
      } );

      table.buttons().container()
          .appendTo( '#listevent_wrapper .col-md-6:eq(0)' );
      $('#tanggal').on('change', function() {
        myChart.destroy();
        table.clear().draw();
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
                updatePie(response.data.status_events);
                var i = 1;
                response.data.list_events.forEach(event => {
                  table.row.add([
                    i,
                    event.tanggal,
                    event.nama,
                    event.status,
                    event.lokasi,
                    event.budget,
                    event.kategori
                  ]).draw();
                  i += 1;
                });
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
      });
    </script>
@endsection