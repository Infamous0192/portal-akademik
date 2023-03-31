@extends('layouts.admin')

@section('title', 'Tambah Program Studi')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Program Studi</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.prodi.index') }}">Program Studi</a></div>
        <div class="breadcrumb-item">Tambah Program Studi</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.prodi.store') }}">
            @csrf
            <div class="card-header">
              <h4>Tambah Program Studi</h4>
            </div>

            <div class="card-body pb-0">
              <div class="row">
                <div class="col-md-6">
                  <x-text-input name="nama" label="Nama" placeholder="Masukan nama" />
                </div>
                <div class="col-md-6">
                  <x-text-input name="kode" label="Kode" placeholder="Masukan Kode" />
                </div>
                <div class="col-md-6">
                  <x-select name="jenjang" label="Jenjang" placeholder="Pilih jenjang" :data="[
                    ['label' => 'D3', 'value' => 'D3'],
                    ['label' => 'S1', 'value' => 'S1'],
                    ['label' => 'S2', 'value' => 'S2'],
                    ['label' => 'S3', 'value' => 'S3'],
                  ]" />
                </div>
                <div class="col-md-6">
                  <x-select name="id_fakultas" label="Fakultas" placeholder="Pilih fakultas" :data="$fakultas"
                    :value="Request::get('fakultas')" />

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