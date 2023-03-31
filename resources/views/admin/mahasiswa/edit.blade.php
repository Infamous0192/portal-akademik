@extends('layouts.admin')

@section('title', 'Edit Mahasiswa')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Mahasiswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a></div>
        <div class="breadcrumb-item">Edit Mahasiswa</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h4>Edit Mahasiswa</h4>
            </div>

            <div class="card-body">
              <x-text-input name="nama" label="Nama" placeholder="Masukan nama" :value="$mahasiswa->nama" />

              <x-text-input name="nim" label="NIM" placeholder="Masukan NIM" :value="$mahasiswa->nim" />

              <x-text-input name="tempat_lahir" label="Tempat Lahir" placeholder="Masukan tempat lahir"
                :value="$mahasiswa->tempat_lahir" />

              <x-text-input type="date" name="tanggal_lahir" label="Tanggal Lahir" placeholder="Masukan tanggal lahir"
                :value="$mahasiswa->tanggal_lahir" />

              <x-text-input name="no_telepon" label="No Telepon" placeholder="Masukan no telepon"
                :value="$mahasiswa->no_telepon" />

              <x-text-area name="alamat" label="Alamat" placeholder="Masukan alamat" :value="$mahasiswa->alamat" />

              <x-select name="jenis_kelamin" label="Jenis Kelamin" placeholder="Pilih jenis kelamin"
                :data="[['label' => 'Laki-laki', 'value' => 'L'], ['label' => 'Perempuan', 'value' => 'P']]"
                :value="$mahasiswa->jenis_kelamin" />

              <x-select name="agama" label="Agama" placeholder="Pilih agama" :data="[
                    ['label' => 'Islam', 'value' => 'Islam'],
                    ['label' => 'Kristen', 'value' => 'Kristen'],
                    ['label' => 'Katolik', 'value' => 'Katolik'],
                    ['label' => 'Hindu', 'value' => 'Hindu'],
                    ['label' => 'Budha', 'value' => 'Budha'],
                    ['label' => 'Lain-lain', 'value' => 'Lain-lain'],
                  ]" :value="$mahasiswa->agama" />

              <x-select name="id_prodi" label="Program Studi" placeholder="Pilih program studi"
                :value="Request::get('prodi')" :data="$prodi" :value="$mahasiswa->id_prodi" />

              <x-file-input name="foto" label="Foto" placeholder="Masukan foto" />
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <a href="{{ route('admin.mahasiswa.index') }}">
                <button type="button" class="btn btn-secondary px-3 mr-2">Kembali</button>
              </a>
              <button type="submit" class="btn btn-primary px-3">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection