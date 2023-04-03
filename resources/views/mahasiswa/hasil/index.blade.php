@extends('layouts.mahasiswa')

@section('title', 'Hasil Studi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Hasil Studi</h1>
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
      <div class="card mb-4">
        <div class="card-header">
          <h4>Hasil Studi</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">
                    #
                  </th>
                  <th>Kode</th>
                  <th>Matakuliah</th>
                  <th>Semester</th>
                  <th>W/P</th>
                  <th>SKS</th>
                  <th>Nilai</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($nilai as $data)
                <tr>
                  <td>
                    {{ ($loop->index + 1) }}
                  </td>
                  <td>{{ $data->kode }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->semester }}</td>
                  <td>{{ $data->kategori }}</td>
                  <td>{{ $data->sks }}</td>
                  <td>
                    {{ ($data->nilai_absen + $data->nilai_tugas + $data->nilai_uts + $data->nilai_uas) / 4 }}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
  $("#table-1").dataTable();
</script>
@endpush