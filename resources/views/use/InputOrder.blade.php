@extends('layouts/contentLayoutMaster')

@section('title', 'Form Layouts')

@section('content')

<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Input Data Order</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal">
            <div class="row">
              <!-- Nama Acara -->
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="event-name">Nama Acara</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="text"
                      id="event-name"
                      class="form-control"
                      name="event-name"
                      placeholder="Nama Acara"
                    />
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
                    <input
                      type="text"
                      id="event-location"
                      class="form-control"
                      name="event-location"
                      placeholder="Lokasi"
                    />
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
                    <input
                      type="text"
                      id="client-name"
                      class="form-control"
                      name="client-name"
                      placeholder="Nama Client"
                    />
                  </div>
                </div>
              </div>

              <!-- Posisi Jabatan Client -->
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="client-position">Posisi Jabatan Client</label>
                  </div>
                  <div class="col-sm-9">
                    <input
                      type="text"
                      id="client-position"
                      class="form-control"
                      name="client-position"
                      placeholder="Posisi Jabatan Client"
                    />
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
                    <input
                      type="datetime-local"
                      id="loading-in-date"
                      class="form-control"
                      name="loading-in-date"
                    />
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
                    <input
                      type="datetime-local"
                      id="event-start-date"
                      class="form-control"
                      name="event-start-date"
                    />
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
                    <input
                      type="datetime-local"
                      id="event-end-date"
                      class="form-control"
                      name="event-end-date"
                    />
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
                    <input
                      type="datetime-local"
                      id="loading-out-date"
                      class="form-control"
                      name="loading-out-date"
                    />
                  </div>
                </div>
              </div>
              
              
              
              <div class="col-sm-9 offset-sm-3">
                <button type="reset" class="btn btn-primary me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  </div>
</section>
<!-- Basic Horizontal form layout section end -->
<!-- Row grouping -->
<section id="row-grouping-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Row Grouping</h4>
        </div>
        <div class="card-datatable">
          <table class="dt-row-grouping table">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>City</th>
                <th>Date</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>City</th>
                <th>Date</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Row grouping -->
@endsection