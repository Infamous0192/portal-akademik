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
                <div class="card-header d-flex justify-content-between">
                    <h4>Hasil Studi</h4>

                    <div class="col-3">

                        <select name="" id="semester" class="form-control form-control-sm rounded-sm p-2" style="height: auto" id="">
                            <option value="" {{ request()->input('akademik') == '' ? 'selected' : '' }}>Pilih Tahun Akademik</option>
                            @foreach ($akademik as $data)
                            <option style="text-transform: capitalize" value="{{ $data->tahunAkademik->id }}" {{ request()->input('akademik') == $data->tahunAkademik->id ? 'selected' : '' }}>{{
                $data->tahunAkademik->nama . ' ' . $data->tahunAkademik->semester }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table-1">
                            <thead>
                                <tr>
                                    <th>Matakuliah</th>
                                    <th>Jumlah SKS</th>
                                    <th>Nilai Absen</th>
                                    <th>Nilai Tugas</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    <th>Nilai Rerata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $data)
                                <tr>
                                    <td>
                                        <strong>{{ $data->matakuliah->kode }}</strong>
                                        <div>{{ $data->matakuliah->nama }}</div>
                                    </td>
                                    <td>{{ $data->matakuliah->sks }}</td>
                                    <td>{{ $data->nilai_absen }}</td>
                                    <td>{{ $data->nilai_tugas }}</td>
                                    <td>{{ $data->nilai_uts }}</td>
                                    <td>{{ $data->nilai_uas }}</td>
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

<script>
    document.getElementById('semester').addEventListener('change', e => {
        window.location.replace(`?akademik=${e.target.value}`)
    })
</script>

<!-- Page Specific JS File -->
<script>
    $("#table-1").dataTable();
</script>
@endpush