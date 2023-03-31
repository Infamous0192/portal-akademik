@extends('layouts.admin')

@section('title', 'Tambah Ruangan')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Ruangan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.ruangan.index') }}">Ruangan</a></div>
        <div class="breadcrumb-item">Tambah Ruangan</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.ruangan.store') }}">
            @csrf
            <div class="card-header">
              <h4>Tambah Ruangan</h4>
            </div>

            <div class="card-body pb-0">
              <x-text-input name="nama" label="Nama" placeholder="Masukan nama" />
              <x-text-input name="kode" label="Kode" placeholder="Masukan kode" />
              <x-select name="id_gedung" label="Gedung" placeholder="Pilih gedung" :value="Request::get('gedung')" :data="$gedung" />
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