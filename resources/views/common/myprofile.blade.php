@extends('layouts.app')

@section('title')
    My Profile
@endsection

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row">

            <div class="card">
                <div class="card-header border-bottom custom-header-color">
                    <h4 class="card-title">User Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Username: </label>
                                </div>
                                <div class="col-sm-9">
                                  <label class="col-form-label">{{ $profile->username }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Nama: </label>
                                </div>
                                <div class="col-sm-9">
                                  <label class="col-form-label">{{ $profile->nama }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Email: </label>
                                </div>
                                <div class="col-sm-9">
                                  <label class="col-form-label">{{ $profile->email }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">No Telp: </label>
                                </div>
                                <div class="col-sm-9">
                                  <label class="col-form-label">{{ $profile->nomer_telepon }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Divisi: </label>
                                </div>
                                <div class="col-sm-9">
                                  <label class="col-form-label">{{ $profile->divisi->nama }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
