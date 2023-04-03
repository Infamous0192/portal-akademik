@extends('layouts.admin')

@section('title', 'Data Tahun Akademik')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tahun Akademik</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Tahun Akademik</div>
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
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Data Tahun Akademik</h4>
              <a href="{{ route('admin.tahun_akademik.create') }}">
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
                      <th>Semester</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tahun_akademik as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td style="text-transform: capitalize">{{ $data->semester }}</td>
                      <td>{{ $data->status == '0' ? 'Aktif' : 'Selesai' }}</td>
                      <td><a href="{{ route('admin.tahun_akademik.show', $data->id) }}"
                          class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Jadwal Akademik</h4>
              <button class="btn btn-primary" data-toggle="modal" data-target="#uploadJadwal">Upload Jadwal</button>
            </div>
            <div class="card-body">
              <iframe src="{{ $jadwal->file }}"
                frameBorder="0" scrolling="auto" height="720px" width="100%"></iframe>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="uploadJadwal">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="POST" action="{{ route('admin.tahun_akademik.upload') }}"
      enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Upload Jadwal Akademik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="file">File</label>
          <input name="file" type="file" class="form-control" id="file" accept="application/pdf">
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
    </form>
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
  $("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [4] }
  ]
});
</script>
@endpush