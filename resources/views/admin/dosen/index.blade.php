@extends('layouts.admin')

@section('title', 'Data Dosen')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dosen</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Dosen</div>
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
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Data Dosen</h4>
              <a href="{{ route('admin.dosen.create') }}">
                <button class="btn btn-sm btn-primary rounded-sm">
                  Tambah
                </button>
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
                      <th>NIP</th>
                      <th>Program Studi</th>
                      <th>Fakultas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dosen as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nip }}</td>
                      <td>{{ $data->prodi->nama }}</td>
                      <td>{{ $data->fakultas->nama }}</td>
                      <td><a href="{{ route('admin.dosen.show', $data->id) }}" class="btn btn-sm btn-primary">Detail</a>
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
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<!-- Page Specific JS File -->
<script>
  $("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [5] }
  ]
});
</script>
@endpush