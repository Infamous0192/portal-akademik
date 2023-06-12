@extends('layouts.admin')

@section('title', 'Tambah Matakuliah')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Matakuliah</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.matakuliah.index') }}">Matakuliah</a></div>
        <div class="breadcrumb-item">Tambah Matakuliah</div>
      </div>
    </div>

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{ session('error') }}
      </div>
    </div>
    @endif

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.matakuliah.store') }}">
            @csrf
            <div class="card-header">
              <h4>Tambah Matakuliah</h4>
            </div>

            <div class="card-body pb-0">
              <div class="row">
                <div class="col-12 col-md-6">
                  <x-text-input name="nama" label="Nama" placeholder="Masukan nama matakuliah" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="kategori" label="Kategori" placeholder="Pilih kategori" :data="[
                    ['label' => 'Wajib (W)', 'value' => 'W'],
                    ['label' => 'Peminatan (P)', 'value' => 'P'],
                  ]" />
                </div>
                <div class="col-12 col-md-6">
                  <x-text-input name="kode" label="Kode" placeholder="Masukan kode matakuliah" />
                </div>
                <div class="col-12 col-md-6">
                  <x-text-input name="sks" type="number" label="SKS" placeholder="Masukan jumlah SKS" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="semester" label="Semester" placeholder="Pilih semester" :data="[
                    ['label' => 'Semester 1', 'value' => '1'],
                    ['label' => 'Semester 2', 'value' => '2'],
                    ['label' => 'Semester 3', 'value' => '3'],
                    ['label' => 'Semester 4', 'value' => '4'],
                    ['label' => 'Semester 5', 'value' => '5'],
                    ['label' => 'Semester 6', 'value' => '6'],
                    ['label' => 'Semester 7', 'value' => '7'],
                    ['label' => 'Semester 8', 'value' => '8'],
                  ]" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="hari" label="Hari" placeholder="Pilih hari" :data="[
                    ['label' => 'Senin', 'value' => 'Senin'],
                    ['label' => 'Selasa', 'value' => 'Selasa'],
                    ['label' => 'Rabu', 'value' => 'Rabu'],
                    ['label' => 'Kamis', 'value' => 'Kamis'],
                    ['label' => 'Jumat', 'value' => 'Jumat'],
                    ['label' => 'Sabtu', 'value' => 'Sabtu'],
                  ]" />
                </div>
                <div class="col-12 col-md-6">
                  <x-time-picker name="waktu_mulai" label="Waktu Mulai" placeholder="Pilih waktu mulai" />
                </div>
                <div class="col-12 col-md-6">
                  <x-time-picker name="waktu_selesai" label="Waktu Selesai" placeholder="Pilih waktu selesai" />
                </div>

                <div class="col-12 col-md-6">
                  <x-select name="id_prodi" label="Program Studi" placeholder="Pilih program studi"
                    :value="Request::get('prodi')" :data="$prodi" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="id_ruangan" label="Ruangan" placeholder="Pilih ruangan"
                    :value="Request::get('ruangan')" :data="$ruangan" />
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

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush