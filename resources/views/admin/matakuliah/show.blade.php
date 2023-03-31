@extends('layouts.admin')

@section('title', 'Detail Matakuliah')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Matakuliah</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.matakuliah.index') }}">Matakuliah</a></div>
        <div class="breadcrumb-item">Detail Matakuliah</div>
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

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <form class="card mb-4" method="POST" action="{{ route('admin.matakuliah.update', $matakuliah->id) }}">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h4>Detail Matakuliah</h4>
            </div>

            <div class="card-body pb-0">
              <div class="row">
                <div class="col-12 col-md-6">
                  <x-text-input name="nama" label="Nama" placeholder="Masukan nama matakuliah"
                    :value="$matakuliah->nama" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="kategori" label="Kategori" placeholder="Pilih kategori" :data="[
                    ['label' => 'Wajib (W)', 'value' => 'W'],
                    ['label' => 'Peminatan (P)', 'value' => 'P'],
                  ]" :value="$matakuliah->kategori" />
                </div>
                <div class="col-12 col-md-6">
                  <x-text-input name="kode" label="Kode" placeholder="Masukan kode matakuliah"
                    :value="$matakuliah->kode" />
                </div>
                <div class="col-12 col-md-6">
                  <x-text-input name="sks" type="number" label="SKS" placeholder="Masukan jumlah SKS"
                    :value="$matakuliah->sks" />
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
                  ]" :value="$matakuliah->semester" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="hari" label="Hari" placeholder="Pilih hari" :data="[
                    ['label' => 'Senin', 'value' => 'Senin'],
                    ['label' => 'Selasa', 'value' => 'Selasa'],
                    ['label' => 'Rabu', 'value' => 'Rabu'],
                    ['label' => 'Kamis', 'value' => 'Kamis'],
                    ['label' => 'Jumat', 'value' => 'Jumat'],
                    ['label' => 'Sabtu', 'value' => 'Sabtu'],
                  ]" :value="$matakuliah->hari" />
                </div>
                <div class="col-12 col-md-6">
                  <x-time-picker name="waktu_mulai" label="Waktu Mulai" placeholder="Pilih waktu mulai"
                    :value="$matakuliah->waktu_mulai" />
                </div>
                <div class="col-12 col-md-6">
                  <x-time-picker name="waktu_selesai" label="Waktu Selesai" placeholder="Pilih waktu selesai"
                    :value="$matakuliah->waktu_selesai" />
                </div>

                <div class="col-12 col-md-6">
                  <x-select name="id_prodi" label="Program Studi" placeholder="Pilih program studi"
                    :value="Request::get('prodi')" :data="$prodi" :value="$matakuliah->id_prodi" />
                </div>
                <div class="col-12 col-md-6">
                  <x-select name="id_ruangan" label="Ruangan" placeholder="Pilih ruangan"
                    :value="Request::get('ruangan')" :data="$ruangan" :value="$matakuliah->id_ruangan" />
                </div>
              </div>
            </div>

            <div class="card-footer pt-0 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary px-3 mr-2">Edit</button>
              <button type="button" class="btn btn-danger px-3" data-toggle="modal"
                data-target="#deleteModal">Hapus</button>
            </div>
          </form>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Daftar Dosen</h4>
              <button class="btn btn-primary rounded-sm" data-toggle="modal" data-target="#addDosenModal">Tambah</button>
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
                      <th>Program Studi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($matakuliah->dosen as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nip }}</td>
                      <td>{{ $data->no_telepon }}</td>
                      <td>{{ $data->prodi->nama }}</td>
                      <td>
                        <a href="{{ route('admin.dosen.show', $data->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <button type="submt" class="btn btn-sm btn-danger"
                          onclick="handleDeleteDosen({{ $data->id }})">Hapus</button>
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
        <h5 class="modal-title">Hapus Matakuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin untuk menghapus matakuliah? semua data terkait matakuliah akan terhapus.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form method="POST" action="{{ route('admin.matakuliah.destroy', $matakuliah->id) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteDosenModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin untuk menghapus dosen ini dalam matakuliah?.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form method="POST" action="{{ route('admin.matakuliah.removeDosen', $matakuliah->id) }}">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id_dosen" id="id_dosen" value="1">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="addDosenModal">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="POST" action="{{ route('admin.matakuliah.addDosen', $matakuliah->id) }}">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Tambah Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <x-select name="id_dosen" label="Dosen" placeholder="Pilih dosen" :data="$dosen" required="true" />
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </form>
  </div>
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
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<script>
  function handleDeleteDosen(id) {
    $(function () {
      $('#deleteDosenModal').modal('toggle');
      $('#id_dosen').val(id);
    });
  }

  $("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [5] }
  ]
});
</script>
@endpush