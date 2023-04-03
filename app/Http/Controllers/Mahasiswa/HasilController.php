<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    /**
     * Display hasil.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)->first();

        $nilai = Nilai::selectRaw('`id_matakuliah`, `nama`, `kode`, `semester`, `kategori`, `sks`, MAX(`nilai_absen`) AS `nilai_absen`, MAX(`nilai_tugas`) AS `nilai_tugas`, MAX(`nilai_uts`) AS `nilai_uts`, MAX(`nilai_uas`) AS `nilai_uas`')
            ->join('matakuliah', 'nilai.id_matakuliah', '=', 'matakuliah.id')
            ->whereIn(
                'id_krs',
                Krs::select('id')
                    ->whereIn(
                        'id_tahun_akademik',
                        TahunAkademik::select('id')
                            ->where('status', 1)
                    )
            )->where('id_mahasiswa', $mahasiswa->id)
            ->groupBy('id_matakuliah')
            ->get();

        return view('mahasiswa.hasil.index', compact('nilai'));
    }
}
