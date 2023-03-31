@extends('layouts.admin')

@section('title', 'Detail Ruangan')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Ruangan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.ruangan.index') }}">Ruangan</a></div>
        <div class="breadcrumb-item">Detail Ruangan</div>
      </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{ session('success') }}
      </div>
    </div>
    @endif

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" action="{{ route('admin.ruangan.update', 1) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-header">
              <h4>Detail Ruangan</h4>
            </div>

            <div class="card-body pb-0">
              <x-text-input name="nama" label="Nama" placeholder="Masukan nama" :value="$ruangan->nama" />
              <x-text-input name="kode" label="Kode" placeholder="Masukan kode" :value="$ruangan->kode" />
              <x-select name="id_gedung" label="Gedung" placeholder="Pilih gedung" :data="$gedung" :value="$ruangan->id_gedung" />
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary px-3 mr-2">Edit</button>
              <button type="button" class="btn btn-danger px-3" data-toggle="modal"
                data-target="#deleteModal">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin untuk menghapus ruangan? semua data terkait ruangan akan terhapus.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form method="POST" action="{{ route('admin.ruangan.destroy', $ruangan->id) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<!-- Page Specific JS File -->
<script>
  let deletedID = 0

  $("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [6] }
  ]
});
</script>
@endpush