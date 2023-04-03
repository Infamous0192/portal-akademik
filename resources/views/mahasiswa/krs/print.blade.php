<!doctype html>
<html lang="en">

<head>
  <title>Cetak Rencana Studi</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style type="text/css">
    table tr td,
    table tr th {
      font-size: 9pt;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="text-center mb-4" style="font-size: 24px; font-weight: bold">Rencana Studi</div>

    <div class="row">
      <table style="font-size: 10pt">
        <tr>
          <td>Semester</td>
          <td class="px-2">:</td>
          <td style="text-transform: capitalize">{{ $krs->akademik->semester . ' ' . $krs->akademik->nama }}</td>
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
            Disetujui
          </td>
        </tr>
      </table>
    </div>

    <table class="table table-bordered mt-4">
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
</body>

</html>