@extends('layouts.admin')

@section('title', 'Detail KRS')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail KRS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.krs.index') }}">Pengajuan KRS</a></div>
        <div class="breadcrumb-item">Detail KRS</div>
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
            <div class="card-header">
              <h4>Biodata Mahasiswa</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="mb-1">Nama Lengkap</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->nama }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Alamat</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->alamat }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Tempat Lahir</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->tempat_lahir }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Tanggal Lahir</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->tanggal_lahir }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Jenis Kelamin</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </h6>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="mb-1">NIM</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->nim }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Agama</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->agama }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">No Telepon</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->no_telepon }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Fakultas</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->fakultas->nama }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Program Studi</div>
                    <h6 class="font-weight-bold">{{ $krs->mahasiswa->prodi->nama }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header d-flex">
              <h4>Matakuliah</h4>
              <div class="d-flex align-items-center justify-content-end" style="flex-grow: 1">
                <form action="{{ route('admin.krs.accept', $krs->id) }}" method="POST" class="form-inline">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-primary mr-2">
                    Terima
                  </button>
                </form>
                <form action="{{ route('admin.krs.reject', $krs->id) }}" method="POST" class="form-inline">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-danger">
                    Tolak
                  </button>
                </form>
              </div>
            </div>
            <div class="card-body">
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
                    </tr>
                    @endforeach
                    <tr>
                      <td colspan="4" class="text-center">
                        <strong>Total SKS</strong>
                      </td>
                      <td>{{ $total_sks }}</td>
                    </tr>
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
        <h5 class="modal-title">Hapus Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin untuk menghapus mahasiswa? semua data terkait mahasiswa akan terhapus.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        {{-- <form method="POST" action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form> --}}
      </div>
    </div>
  </div>
</div>
@endsection