@extends('layouts.admin')

@section('title', 'Edit Tahun Akademik')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Tahun Akademik</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.tahun_akademik.index') }}">Tahun Akademik</a></div>
        <div class="breadcrumb-item">Edit Tahun Akademik</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.tahun_akademik.update', $tahun_akademik->id) }}">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h4>Edit Tahun Akademik</h4>
            </div>

            <div class="card-body">
              <x-text-input name="nama" label="Nama" placeholder="Masukan nama" :value="$tahun_akademik->nama" />

              <x-select name="semester" label="Semester" placeholder="Pilih semester" :data="[
                    ['label' => 'Ganjil', 'value' => 'ganjil'],
                    ['label' => 'Genap', 'value' => 'genap'],
                  ]" :value="$tahun_akademik->semester" />

              <x-select name="status" label="Status" placeholder="Pilih status" :data="[
                    ['label' => 'Aktif', 'value' => '0'],
                    ['label' => 'Selesai', 'value' => '1'],
                  ]" :value="$tahun_akademik->status" />
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <a href="{{ route('admin.tahun_akademik.index') }}">
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