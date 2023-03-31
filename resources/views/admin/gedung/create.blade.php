@extends('layouts.admin')

@section('title', 'Tambah Gedung')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Gedung</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.gedung.index') }}">Gedung</a></div>
        <div class="breadcrumb-item">Tambah Gedung</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.gedung.store') }}">
            @csrf
            <div class="card-header">
              <h4>Tambah Gedung</h4>
            </div>

            <div class="card-body pb-0">
              <div class="row">
                <div class="col-md-6">
                  <x-text-input name="nama" label="Nama" placeholder="Masukan nama" />
                </div>
                <div class="col-md-6">
                  <x-text-input name="kode" label="Kode" placeholder="Masukan kode" />
                </div>
              </div>
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary px-3">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection