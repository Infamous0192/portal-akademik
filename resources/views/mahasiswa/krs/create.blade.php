@extends('layouts.mahasiswa')

@section('title', 'Tambah KRS')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah KRS</h1>
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
          <div class="card mb-4">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <table>
                    <tr>
                      <td>Semester</td>
                      <td class="px-2">:</td>
                      <td style="text-transform: capitalize">{{ "$akademik->semester $akademik->nama" }}</td>
                    </tr>
                    <tr>
                      <td>SKS Maksimal</td>
                      <td class="px-2">:</td>
                      <td style="text-transform: capitalize">{{ $max_sks }}</td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <div class="d-flex justify-content-end">
                    <a href="{{ route('mahasiswa.krs.index') }}">
                      <button class="btn btn-secondary px-4">
                        Kembali
                      </button>
                    </a>
                  </div>
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
                      <th>Dosen</th>
                      <th>SKS</th>
                      <th>Jumlah Mahasiswa</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($matakuliah as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td>
                        <strong>{{ $data->kode }}</strong>
                        <div>{{ $data->nama }}</div>
                      </td>
                      <td>{{ $data->semester }}</td>
                      <td>
                        <div>{{ $data->hari }}</div>
                        <div>{{ $data->waktu_mulai }} - {{ $data->waktu_selesai }}</div>
                      </td>
                      <td>
                        @if (count($data->dosen) > 0)
                        <ul class="pl-0">
                          @foreach ($data->dosen as $dosen)
                          <li>{{ $dosen->nama }} ({{ $dosen->nip }})</li>
                          @endforeach
                        </ul>
                        @else
                        Belum ada dosen pengampu
                        @endif
                      </td>
                      <td>{{ $data->sks }}</td>
                      <td>{{ $data->nilai_count }}</td>
                      <td>
                        <form method="POST" class="form-inline" action="{{ route('mahasiswa.krs.store') }}">
                          @csrf
                          <input type="hidden" name="id_matakuliah" value="{{ $data->id }}">
                          <input type="hidden" name="id_tahun_akademik" value="{{ $akademik->id }}">
                          <button class="btn btn-primary btn-sm" type="submit">Ambil SKS</button>
                        </form>
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