@extends('layouts.mahasiswa')

@section('title', 'Rencana Studi')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Rencana Studi</h1>
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

    @if ($akademik == null || $akademik->status == 1)

    <div class="alert alert-info">
      <div class="alert-body">
        Pengisian KRS belum dibuka
      </div>
    </div>

    @else

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row mb-5">
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
                      <td style="text-transform: capitalize">20</td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td class="px-2">:</td>
                      <td style="text-transform: capitalize">
                        @if ($krs != null)
                        @switch($krs->status)
                        @case('process')
                        <div class="badge badge-info rounded px-2 py-1" style="font-size: 10px">
                          Menunggu Persetujuan
                        </div>
                        @break
                        @case('accepted')
                        <div class="badge badge-success rounded px-2 py-1" style="font-size: 10px">
                          Disetujui
                        </div>
                        @break
                        @case('rejected')
                        <div class="badge badge-danger rounded px-2 py-1" style="font-size: 10px">
                          Ditolak
                        </div>
                        @break
                        @default
                        <div class="badge badge-secondary rounded px-2 py-1" style="font-size: 10px">
                          Belum Mengajukan
                        </div>
                        @endswitch
                        @else
                        <div class="badge badge-secondary rounded px-2 py-1" style="font-size: 10px">
                          Belum Mengajukan
                        </div>
                        @endif
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <div class="d-flex flex-column justify-content-center align-items-end">
                    @if (($krs == null || $krs->status == 'pending' || $krs->status == 'rejected') && $akademik->status
                    == 0)
                    <a href="{{ route('mahasiswa.krs.create') }}" class="">
                      <button class="btn rounded-pill btn-primary px-5">Tambah KRS</button>
                    </a>
                    @endif
                    @if ($krs != null && $matakuliah != null && count($matakuliah) > 0)
                    @if (($krs->status == 'pending' || $krs->status == 'rejected') && $akademik->status == 0)
                    <form method="POST" action="{{ route('mahasiswa.krs.submit', $krs->id) }}" class="mt-2">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="btn btn-outline-primary px-5 rounded-pill">Ajukan KRS</button>
                    </form>
                    @endif
                    @endif
                    @if ($krs != null && $krs->status == 'accepted')
                    <a href="{{ route('mahasiswa.krs.print') }}">
                      <button class="btn btn-info px-5 rounded-pill">Cetak KRS</button>
                    </a>
                    @endif
                    @if ($krs != null && ($krs->status == 'process' || $krs->status == 'accepted') && $akademik->status
                    == 0)
                    <form method="POST" action="{{ route('mahasiswa.krs.revise', $krs->id) }}" class="mt-2">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="btn btn-secondary px-5 rounded-pill">Revisi KRS</button>
                    </form>
                    @endif
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Matakuliah</th>
                      <th>Dosen</th>
                      <th>Jadwal</th>
                      <th>SKS</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($krs == null || count($matakuliah) == 0)
                    <tr>
                      <td colspan="6" class="text-center">Belum Mengajukan KRS</td>
                    </tr>
                    @else
                    @foreach ($matakuliah as $data)
                    <tr>
                      <td>
                        {{ ($loop->index + 1) }}
                      </td>
                      <td class="py-2">
                        <strong>{{ $data->kode }}</strong>
                        <div>{{ $data->nama }}</div>
                        <div>Semester {{ $data->semester }}</div>
                      </td>
                      <td>
                        <ul class="pl-0">
                          @foreach ($data->dosen as $dosen)
                          <li>{{ $dosen->nama }} ({{ $dosen->nip }})</li>
                          @endforeach
                        </ul>
                      </td>
                      <td>
                        <div>{{ $data->hari }}</div>
                        <div>{{ $data->waktu_mulai }} - {{ $data->waktu_selesai }}</div>
                      </td>
                      <td>{{ $data->sks }}</td>
                      <td>
                        @if ($krs->status == 'pending' || $krs->status == 'rejected')
                        <form method="POST"
                          action="{{ route('mahasiswa.krs.removeMatakuliah', ['krs' => $krs->id, 'matakuliah' => $data->id]) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">
                            Hapus
                          </button>
                        </form>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    <tr>
                      <td colspan="5" class="text-center">
                        <strong>Total SKS</strong>
                      </td>
                      <td>{{ $total_sks }}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </section>
</div>
@endsection