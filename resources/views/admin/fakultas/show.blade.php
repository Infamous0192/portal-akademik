@extends('layouts.admin')

@section('title', 'Detail Fakultas')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Fakultas</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.fakultas.index') }}">Fakultas</a></div>
        <div class="breadcrumb-item">Detail Fakultas</div>
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
          <form class="card mb-4" action="{{ route('admin.fakultas.update', 1) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-header">
              <h4>Detail Fakultas</h4>
            </div>

            <div class="card-body pb-0">
              <div class="row">
                <div class="col-md-6">
                  <x-text-input name="nama" label="Nama" placeholder="Masukan nama" :value="$fakultas->nama" />
                </div>
                <div class="col-md-6">
                  <x-text-input name="kode" label="Kode" placeholder="Masukan kode" :value="$fakultas->kode" />
                </div>
              </div>
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary px-3 mr-2">Edit</button>
              <button type="button" class="btn btn-danger px-3" data-toggle="modal"
                data-target="#deleteModal">Hapus</button>
            </div>
          </form>

          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Daftar Program Studi</h4>
              <a href="{{ route('admin.prodi.create') }}">
                <button class="btn btn-primary rounded-sm">Tambah</button>
              </a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Nama</th>
                      <th>Kode</th>
                      <th>Jenjang</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fakultas->prodi as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->kode }}</td>
                      <td>{{ $data->jenjang }}</td>
                      <td>{{ $data->created_at }}</td>
                      <td>{{ $data->updated_at }}</td>
                      <td><a href="{{ route('admin.prodi.show', $data->id) }}" class="btn btn-sm btn-primary">Detail</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Fakultas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin untuk menghapus fakultas? semua data terkait fakultas akan terhapus.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form method="POST" action="{{ route('admin.fakultas.destroy', $fakultas->id) }}">
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