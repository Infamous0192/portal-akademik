@extends('layouts.mahasiswa')

@section('title', 'Dashboard')

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
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
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                  <img src="{{ $mahasiswa->foto }}" alt="" class="w-100 border rounded" />
                </div>
                <div class="col-md-10">
                  <h3>{{ $mahasiswa->nama }}</h3>

                  <div class="mt-4">
                    <table>
                      <tr class="py-2">
                        <td class="font-weight-bold py-1" style="width: 130px">NIM</td>
                        <td> {{ $mahasiswa->nim }}</td>
                      </tr>
                      <tr class="py-2">
                        <td class="font-weight-bold py-1" style="width: 130px">Fakultas</td>
                        <td>{{ $mahasiswa->fakultas->nama }}</td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold py-1" style="width: 130px">Program Studi</td>
                        <td>{{ $mahasiswa->prodi->nama }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h4>Biodata Mahasiswa</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="mb-1">Nama Lengkap</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->nama }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Alamat</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->alamat }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Tempat Lahir</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->tempat_lahir }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Tanggal Lahir</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->tanggal_lahir }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Jenis Kelamin</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</h6>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="mb-1">NIM</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->nim }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Agama</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->agama }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">No Telepon</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->no_telepon }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Fakultas</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->fakultas->nama }}</h6>
                  </div>
                  <div class="mb-4">
                    <div class="mb-1">Program Studi</div>
                    <h6 class="font-weight-bold">{{ $mahasiswa->prodi->nama }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection