<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display jadwal kuliah.
     *
     * @return \Illuminate\Http\Response
     */
    public function kuliah()
    {
        $akademik = TahunAkademik::orderBy('id', 'desc')->first();
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $krs = Krs::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_tahun_akademik', $akademik->id ?? 0)
            ->first();

        if ($krs == null || $krs->status != 'accepted') {
            return view('mahasiswa.jadwal.kuliah', ['krs' => null]);
        }

        $matakuliah = Matakuliah::whereIn('id', Nilai::select('id_matakuliah')->where('id_krs', $krs->id))->get();

        return view('mahasiswa.jadwal.kuliah', compact('krs', 'matakuliah'));
    }

    /**
     * Display jadwal akademik.
     *
     * @return \Illuminate\Http\Response
     */
    public function akademik()
    {
        $tahun_akademik = TahunAkademik::all();
        $jadwal = Jadwal::orderBy('created_at', 'DESC')->first();

        return view('mahasiswa.jadwal.akademik', compact('jadwal'));
    }
}
