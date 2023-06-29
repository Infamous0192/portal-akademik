@extends('layouts.admin')

@section('title', 'Data Mahasiswa')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Mahasiswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Mahasiswa</div>
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
              <h4>Data Mahasiswa</h4>
              <a href="{{ route('admin.mahasiswa.create') }}">
                <button class="btn btn-sm btn-primary rounded-sm">
                  Tambah
                </button>
              </a>
            </div>

            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-3">
                  <select name="" id="fakultas-filter" class="form-control">
                    <option value="">Pilih Fakultas</option>
                    @foreach ($fakultas as $data)
                    <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <select name="" id="prodi-filter" class="form-control">
                    <option value="">Pilih Prodi</option>
                    @foreach ($prodi as $data)
                    <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Nama</th>
                      <th>NIM</th>
                      <th>Program Studi</th>
                      <th>Fakultas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mahasiswa as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nim }}</td>
                      <td>{{ $data->prodi->nama }}</td>
                      <td>{{ $data->fakultas->nama }}</td>
                      <td><a href="{{ route('admin.mahasiswa.show', $data->id) }}"
                          class="btn btn-sm btn-primary">Detail</a>
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
  const table1 = $("#table-1").DataTable({
    "columnDefs": [
      { "sortable": false, "targets": [5] }
    ]
  });

  $('#fakultas-filter').on('change', function() {
    var filterValue = $(this).val();

    table1
      .columns(4)
      .search(filterValue)
      .draw();
  });

  $('#prodi-filter').on('change', function() {
    var filterValue = $(this).val();

    table1
      .columns(3)
      .search(filterValue)
      .draw();
  });
</script>
@endpush