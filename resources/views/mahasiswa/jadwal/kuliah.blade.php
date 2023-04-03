@extends('layouts.mahasiswa')

@section('title', 'Jadwal Perkuliahan')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Jadwal Perkuliahan</h1>
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

    @if ($krs == null || $matakuliah == null)
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        Belum mengajukan KRS.
      </div>
    </div>
    @else
    <div class="section-body">
      <div class="card mb-4">
        <div class="card-header">
          <h4>Jadwal Perkuliahan</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">
                    #
                  </th>
                  <th>Matakuliah</th>
                  <th>Semester</th>
                  <th>SKS</th>
                  <th>Ruangan</th>
                  <th>Jadwal</th>
                  <th>Dosen</th>
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
                  <td>{{ $data->sks }}</td>
                  <td>{{ $data->ruangan->nama }}</td>
                  <td>
                    <div>{{ $data->hari }}</div>
                    <div>{{ $data->waktu_mulai }} - {{ $data->waktu_selesai }}</div>
                  </td>
                  <td>
                    <ul class="pl-0">
                      @foreach ($data->dosen as $dosen)
                      <li>{{ $dosen->nama }} ({{ $dosen->nip }})</li>
                      @endforeach
                    </ul>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif
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
  $("#table-1").dataTable();
</script>
@endpush