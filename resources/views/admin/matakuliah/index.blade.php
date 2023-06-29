@extends('layouts.admin')

@section('title', 'Data Matakuliah')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Matakuliah</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Matakuliah</div>
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
              <h4>Data Matakuliah</h4>
              <a href="{{ route('admin.matakuliah.create') }}">
                <button class="btn btn-sm btn-primary rounded-sm">
                  Tambah
                </button>
              </a>
            </div>

            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-3">
                  <select name="" id="kategori-filter" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <option value="Wajib">Wajib</option>
                    <option value="Peminatan">Peminatan</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <select name="" id="semester-filter" class="form-control">
                    <option value="">Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <select name="" id="fakultas-filter" class="form-control">
                    <option value="">Pilih Fakultas</option>
                    @foreach ($fakultas as $data)
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
                      <th>Matakuliah</th>
                      <th>Semester</th>
                      <th>Jadwal</th>
                      <th>Kategori</th>
                      <th>Fakultas</th>
                      <th>Jumlah Mahasiswa</th>
                      <th>Dosen Pengampu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($matakuliah as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td class="py-2">
                        <strong>{{ $data->kode }}</strong>
                        <div>{{ $data->nama }}</div>
                      </td>
                      <td>{{ $data->semester }}</td>
                      <td>
                        <div>
                          <strong>{{ $data->hari }}</strong>
                        </div>
                        <div>{{ $data->waktu_mulai }} - {{ $data->waktu_selesai }}</div>
                      </td>
                      <td>{{ $data->kategori == 'W' ? 'Wajib' : 'Peminatan' }}</td>
                      <td>{{ $data->fakultas->nama }}</td>
                      <td>{{ $data->nilai_count }}</td>
                      <td>
                        @if (count($data->dosen) > 0)
                        <ul class="pl-0">
                          @foreach ($data->dosen as $dosen)
                          <li>{{ $dosen->nama }}</li>
                          @endforeach
                        </ul>
                        @else
                        <div>(Belum Ada Dosen Pengampu)</div>
                        @endif
                      </td>
                      <td><a href="{{ route('admin.matakuliah.show', $data->id) }}"
                          class="btn btn-sm btn-primary">Detail</a></td>
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
      { "sortable": false, "targets": [8] }
    ]
  });

  $('#kategori-filter').on('change', function() {
    var filterValue = $(this).val();

    table1
      .columns(4)
      .search(filterValue)
      .draw();
  });

  $('#semester-filter').on('change', function() {
    var filterValue = $(this).val();

    table1
      .columns(2)
      .search(filterValue)
      .draw();
  });

  $('#fakultas-filter').on('change', function() {
    var filterValue = $(this).val();

    table1
      .columns(5)
      .search(filterValue)
      .draw();
  });
</script>
</script>
@endpush