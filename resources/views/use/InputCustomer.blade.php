@extends('layouts/contentLayoutMaster')

@section('title', 'Form Layouts')

@section('content')

<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Input Data Pelanggan</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal">
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="fname-icon">Nama Pelanggan</label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i data-feather="user"></i></span>
                      <input
                        type="text"
                        id="fname-icon"
                        class="form-control"
                        name="fname-icon"
                        placeholder="Nama Pelanggan"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="contact-icon">No Telpon</label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i data-feather="smartphone"></i></span>
                      <input
                        type="number"
                        id="contact-icon"
                        class="form-control"
                        name="contact-icon"
                        placeholder="No Telpon"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="email-icon">Email</label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i data-feather="mail"></i></span>
                      <input
                        type="email"
                        id="email-icon"
                        class="form-control"
                        name="email-id-icon"
                        placeholder="Email"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="address-icon">Alamat</label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i data-feather="map-pin"></i></span>
                      <input
                        type="text"
                        id="address-icon"
                        class="form-control"
                        name="address"
                        placeholder="Alamat"
                      />
                    </div>
                  </div>
                </div>
              </div>
              {{-- BATAS INPUT GROUP --}}
              <div class="row">
                <div class="col-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Tipe Pelanggan</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                      <div class="input-group">
                        
                        <select class="form-select" id="inputGroupSelect01">
                          <option selected="">Choose...</option>
                          <option value="1">EO</option>
                          <option value="2">Direct Client</option>
                          <option value="3">Vendor</option>
                          <option value="4">Panitia</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- BATAS INPUT GROUP --}}
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="company-name-icon">Nama Entitas</label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i data-feather="briefcase"></i></span>
                      <input
                        type="text"
                        id="company-name-icon"
                        class="form-control"
                        name="company-name"
                        placeholder="Nama Entitas"
                      />
                    </div>
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

@endsection