<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\TahunAkademik;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    /**
     * Display Rencana Studi
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akademik = TahunAkademik::orderBy('id', 'desc')->first();
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $krs = Krs::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_tahun_akademik', $akademik->id ?? 0)
            ->first();

        $data = [
            'akademik' => $akademik,
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
        ];

        if ($krs == null) {
            return view('mahasiswa.krs.index', $data);
        }

        $data['matakuliah'] = Matakuliah::whereIn('id', DB::table('nilai')->select('id_matakuliah')->where('id_krs', $krs->id))->get();
        $data['total_sks'] = 0;

        foreach ($data['matakuliah'] as $item) {
            $data['total_sks'] += $item->sks;
        }

        return view('mahasiswa.krs.index', $data);
    }

    /**
     * Add KRS
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akademik = TahunAkademik::orderBy('id', 'desc')->first();
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $max_sks = 20;
        $krs = Krs::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_tahun_akademik', $akademik->id)
            ->first();
        $matakuliah = Matakuliah::whereIn('semester', $akademik->semester == 'ganjil' ? [1, 3, 5, 7] : [2, 4, 6, 8])->where('id_prodi', $mahasiswa->id_prodi);

        if ($krs == null) {
            return view('mahasiswa.krs.create', [
                'akademik' => $akademik,
                'mahasiswa' => $mahasiswa,
                'max_sks' => $max_sks,
                'krs' => null,
                'matakuliah' => $matakuliah->get()
            ]);
        }

        $matakuliah = Matakuliah::whereIn('semester', $akademik->semester == 'ganjil' ? [1, 3, 5, 7] : [2, 4, 6, 8])
            ->whereNotIn('id', Nilai::select('id_matakuliah')->where('id_krs', $krs->id))
            ->get();

        $nilai = Nilai::where('id_krs', $krs->id)->get();

        foreach ($nilai as $item) {
            $max_sks -= $item->matakuliah->sks;
        }

        return view('mahasiswa.krs.create', [
            'akademik' => $akademik,
            'mahasiswa' => $mahasiswa,
            'max_sks' => $max_sks,
            'krs' => null,
            'matakuliah' => $matakuliah
        ]);
    }

    /**
     * Add KRS
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $max_krs = 20;
        $matakuliah = Matakuliah::find($request->get('id_matakuliah'));

        if (Krs::isScheduleConflict($mahasiswa->id, $request->get('id_matakuliah'))) {
            return redirect()->back()->with('error', 'Jadwal bentrok');
        }

        if (count($matakuliah->dosen) == 0) {
            return redirect()->back()->with('error', 'Belum ada dosen pengampu');
        }

        $krs = Krs::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_tahun_akademik', $request->get('id_tahun_akademik'))
            ->first();

        if ($krs == null) {
            $krs = Krs::create([
                'status' => 'pending',
                'id_mahasiswa' => $mahasiswa->id,
                'id_tahun_akademik' => $request->get('id_tahun_akademik')
            ]);
        }

        $sks = Matakuliah::whereIn('id', Nilai::select('id_matakuliah')->where('id_krs', $krs->id))->get();

        foreach ($sks as $item) {
            $max_krs -= $item->sks;
        }

        if ($matakuliah->sks > $max_krs) {
            return redirect()->back()->with('error', 'SKS melebih batas maksimal');
        }

        Nilai::create([
            'nilai_absen' => 0,
            'nilai_tugas' => 0,
            'nilai_uts' => 0,
            'nilai_uas' => 0,
            'id_mahasiswa' => $mahasiswa->id,
            'id_matakuliah' => $matakuliah->id,
            'id_krs' => $krs->id
        ]);

        return redirect()->route('mahasiswa.krs.index')->with('success', 'KRS berhasil ditambahkan');
    }

    /**
     * Submit KRS
     *
     * @return \Illuminate\Http\Response
     */
    public function submit(Krs $krs)
    {
        $krs->status = 'process';
        $krs->save();

        return redirect()->route('mahasiswa.krs.index')->with('success', 'KRS berhasil diajukan');
    }

    /**
     * Revise KRS.
     *
     * @return \Illuminate\Http\Response
     */
    public function revise(Krs $krs)
    {
        $krs->status = 'pending';
        $krs->save();

        return redirect()->route('mahasiswa.krs.index')->with('success', 'KRS berhasil direvisi');
    }

    /**
     * Remove Matakuliah
     *
     * @return \Illuminate\Http\Response
     */
    public function removeMatakuliah(Krs $krs, Matakuliah $matakuliah)
    {
        Nilai::where('id_krs', $krs->id)
            ->where('id_matakuliah', $matakuliah->id)
            ->delete();

        return redirect()->route('mahasiswa.krs.index')->with('success', 'Matakuliah berhasil dihapus');
    }

    /**
     * Print KRS.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $akademik = TahunAkademik::orderBy('id', 'desc')->first();
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $krs = Krs::where('id_mahasiswa', $mahasiswa->id)
            ->where('id_tahun_akademik', $akademik->id)
            ->first();

        $data = [
            'akademik' => $akademik,
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
        ];

        if ($krs == null) {
            return view('mahasiswa.krs.index', $data);
        }

        $data['matakuliah'] = Matakuliah::whereIn('id', DB::table('nilai')->select('id_matakuliah')->where('id_krs', $krs->id))->get();
        $data['total_sks'] = 0;

        foreach ($data['matakuliah'] as $item) {
            $data['total_sks'] += $item->sks;
        }

        $pdf = Pdf::loadView('mahasiswa.krs.print', $data);

        return $pdf->download('rencana_studi.pdf');
    }
}
