@extends('layouts.admin')

@section('title', 'Detail Program Studi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Program Studi</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.prodi.index') }}">Program Studi</a></div>
        <div class="breadcrumb-item">Detail Program Studi</div>
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
          <form class="card mb-4" action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-header">
              <h4>Detail Program Studi</h4>
            </div>

            <div class="card-body pb-0">
              <div class="row">
                <div class="col-md-6">
                  <x-text-input name="nama" label="Nama" placeholder="Masukan nama" :value="$prodi->nama" />

                </div>
                <div class="col-md-6">
                  <x-text-input name="kode" label="Kode" placeholder="Masukan Kode" :value="$prodi->kode" />

                </div>
                <div class="col-md-6">
                  <x-select name="jenjang" label="Jenjang" placeholder="Pilih jenjang" :data="[
                    ['label' => 'D3', 'value' => 'D3'],
                    ['label' => 'S1', 'value' => 'S1'],
                    ['label' => 'S2', 'value' => 'S2'],
                    ['label' => 'S3', 'value' => 'S3'],
                  ]" :value="$prodi->jenjang" />
                </div>
                <div class="col-md-6">
                  <x-select name="id_fakultas" label="Fakultas" placeholder="Pilih fakultas" :data="$fakultas"
                    :value="$prodi->id_fakultas" />
                </div>
              </div>
            </div>
            <div class="card-footer pt-0 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary px-3 mr-2">Edit</button>
              <button type="button" class="btn btn-danger px-3" data-toggle="modal"
                data-target="#deleteModal">Hapus</button>
            </div>
          </form>

          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Daftar Dosen</h4>
              <a href="{{ route('admin.dosen.create', ['prodi' => $prodi->id]) }}">
                <button class="btn btn-primary rounded">Tambah</button>
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
                      <th>No Telepon</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($prodi->dosen as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nip }}</td>
                      <td>{{ $data->no_telepon }}</td>
                      <td>{{ $data->created_at }}</td>
                      <td>{{ $data->updated_at }}</td>
                      <td><a href="{{ route('admin.dosen.show', $data->id) }}" class="btn btn-sm btn-primary">Detail</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Daftar Mahasiswa</h4>
              <a href="{{ route('admin.mahasiswa.create', ['prodi' => $prodi->id]) }}">
                <button class="btn btn-primary rounded">Tambah</button>
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="table-2">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Nama</th>
                      <th>NIM</th>
                      <th>No Telepon</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($prodi->mahasiswa as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nim }}</td>
                      <td>{{ $data->no_telepon }}</td>
                      <td>{{ $data->created_at }}</td>
                      <td>{{ $data->updated_at }}</td>
                      <td><a href="{{ route('admin.mahasiswa.show', $data->id) }}" class="btn btn-sm btn-primary">Detail</a>
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
        <h5 class="modal-title">Hapus Prodi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin untuk menghapus prodi? semua data terkait prodi akan terhapus.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form method="POST" action="{{ route('admin.prodi.destroy', $prodi->id) }}">
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
  $("#table-2").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [6] }
  ]
});
</script>
@endpush