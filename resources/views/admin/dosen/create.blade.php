@extends('layouts.admin')

@section('title', 'Tambah Dosen')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Dosen</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.dosen.index') }}">Dosen</a></div>
        <div class="breadcrumb-item">Tambah Dosen</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.dosen.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
              <h4>Tambah Dosen</h4>
            </div>

            <div class="card-body">
              <x-text-input name="nama" label="Nama" placeholder="Masukan nama" />

              <x-text-input name="nip" label="NIP" placeholder="Masukan NIP" />

              <x-text-input name="tempat_lahir" label="Tempat Lahir" placeholder="Masukan tempat lahir" />

              <x-text-input type="date" name="tanggal_lahir" label="Tanggal Lahir"
                placeholder="Masukan tanggal lahir" />

              <x-text-input name="no_telepon" label="No Telepon" placeholder="Masukan no telepon" />

              <x-text-area name="alamat" label="Alamat" placeholder="Masukan alamat" />

              <x-select name="jenis_kelamin" label="Jenis Kelamin" placeholder="Pilih jenis kelamin"
                :data="[['label' => 'Laki-laki', 'value' => 'L'], ['label' => 'Perempuan', 'value' => 'P']]" />

              <x-select name="agama" label="Agama" placeholder="Pilih agama" :data="[
                    ['label' => 'Islam', 'value' => 'Islam'],
                    ['label' => 'Kristen', 'value' => 'Kristen'],
                    ['label' => 'Katolik', 'value' => 'Katolik'],
                    ['label' => 'Hindu', 'value' => 'Hindu'],
                    ['label' => 'Budha', 'value' => 'Budha'],
                    ['label' => 'Lain-lain', 'value' => 'Lain-lain'],
                  ]" />

              <x-select name="id_prodi" label="Program Studi" placeholder="Pilih program studi" :value="Request::get('prodi')" :data="$prodi" />

              <x-file-input name="foto" label="Foto" placeholder="Masukan foto" />
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <a href="{{ route('admin.dosen.index') }}">
                <button type="button" class="btn btn-secondary px-3 mr-2">Kembali</button>
              </a>
              <button type="submit" class="btn btn-primary px-3">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection