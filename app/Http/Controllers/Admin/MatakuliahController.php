<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatakuliahDosenRequest;
use App\Http\Requests\MatakuliahRequest;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\Ruangan;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matakuliah = Matakuliah::withCount(['nilai' => function (Builder $query) {
            $akademik = TahunAkademik::orderBy('id', 'desc')->first();
            $query->where('id_tahun_akademik', $akademik->id ?? 0);
        }])->get();

        $fakultas = Fakultas::all();

        return view('admin.matakuliah.index', compact('matakuliah', 'fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fakultas = Fakultas::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });
        $ruangan = Ruangan::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->gedung->nama . ')', 'value' => $item->id];
        });

        return view('admin.matakuliah.create', compact('fakultas', 'ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatakuliahRequest $request)
    {
        $waktu_mulai = Carbon::createFromFormat('h:i a', $request->get('waktu_mulai'))->format('H:i:s');
        $waktu_selesai = Carbon::createFromFormat('h:i a', $request->get('waktu_selesai'))->format('H:i:s');
        $semester = $request->get('semester') % 2 ? [1, 3, 5, 7] : [2, 4, 8];

        // if (!Matakuliah::isScheduleAvailable($request->get('hari'), $waktu_mulai, $waktu_selesai, $semester)) {
        //     return redirect()->back()->withInput()->with('error', 'Jadwal bentrok');
        // }

        if (!Matakuliah::isRoomAvailable($request->get('hari'), $request->get('id_ruangan'), $waktu_mulai, $waktu_selesai, $semester)) {
            return redirect()->back()->withInput()->with('error', 'Ruangan telah terpakai');
        }

        Matakuliah::create([
            ...$request->except(['waktu_mulai', 'waktu_selesai']),
            'waktu_mulai' => Carbon::createFromFormat('h:i a', $request->get('waktu_mulai'))->format('H:i:s'),
            'waktu_selesai' => Carbon::createFromFormat('h:i a', $request->get('waktu_selesai'))->format('H:i:s'),
        ]);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matakuliah $matakuliah)
    {
        $fakultas = Fakultas::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });
        $ruangan = Ruangan::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->gedung->nama . ')', 'value' => $item->id];
        });

        $dosen = Dosen::select('dosen.nama', 'dosen.id', 'dosen.nip')
            ->where('id_fakultas', $matakuliah->id_fakultas)
            ->whereNotIn('id', DB::table('matakuliah_dosen')->select('id_dosen')->where('id_matakuliah', $matakuliah->id))
            ->get()->map(function ($item, $key) {
                return ['label' => $item->nama . ' (' . $item->nip . ')', 'value' => $item->id];
            });

        $akademik = TahunAkademik::orderBy('id', 'desc')->first();
        $nilai = Nilai::where('id_matakuliah', $matakuliah->id)
            ->whereIn('id_krs', Krs::select('id')->where('id_tahun_akademik', $akademik->id ?? 0))->get();

        $rekapitulasi = Nilai::whereIn('id', function ($query) use ($matakuliah) {
            $query->select(DB::raw('MAX(id)'))
                ->from('nilai')
                ->where('id_matakuliah', $matakuliah->id)
                ->groupBy('id_mahasiswa');
        })->get();

        return view('admin.matakuliah.show', compact('matakuliah', 'rekapitulasi', 'fakultas', 'ruangan', 'dosen', 'nilai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matakuliah $matakuliah)
    {
        $fakultas = Fakultas::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });
        $ruangan = Ruangan::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->gedung->nama . ')', 'value' => $item->id];
        });

        $dosen = Dosen::select('dosen.nama', 'dosen.id', 'dosen.nip')
            ->where('id_fakultas', $matakuliah->id_fakultas)
            ->whereNotIn('id', DB::table('matakuliah_dosen')->select('id_dosen')->where('id_matakuliah', $matakuliah->id))
            ->get()->map(function ($item, $key) {
                return ['label' => $item->nama . ' (' . $item->nip . ')', 'value' => $item->id];
            });

        return view('admin.matakuliah.show', compact('matakuliah', 'fakultas', 'ruangan', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatakuliahRequest $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $waktu_mulai = Carbon::createFromFormat('h:i a', $request->get('waktu_mulai'))->format('H:i:s');
        $waktu_selesai = Carbon::createFromFormat('h:i a', $request->get('waktu_selesai'))->format('H:i:s');
        $semester = $request->get('semester') % 2 ? [1, 3, 5, 7] : [2, 4, 8];

        // if (!Matakuliah::isScheduleAvailable($request->get('hari'), $waktu_mulai, $waktu_selesai, $semester, $matakuliah->id)) {
        //     return redirect()->back()->withInput()->with('error', 'Jadwal bentrok');
        // }

        if (!Matakuliah::isRoomAvailable($request->get('hari'), $request->get('id_ruangan'), $waktu_mulai, $waktu_selesai, $semester, $matakuliah->id)) {
            return redirect()->back()->withInput()->with('error', 'Ruangan telah terpakai');
        }

        $matakuliah->update([
            ...$request->except(['waktu_mulai', 'waktu_selesai']),
            'waktu_mulai' => Carbon::createFromFormat('h:i a', $request->get('waktu_mulai'))->format('H:i:s'),
            'waktu_selesai' => Carbon::createFromFormat('h:i a', $request->get('waktu_selesai'))->format('H:i:s'),
        ]);

        return redirect()->route('admin.matakuliah.show', $id)->with('success', 'Matakuliah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('admin.matakuliah.index')->with('success', 'Matakuliah berhasil dihapus');
    }

    /**
     * Edit nilai.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function nilai(Matakuliah $matakuliah, Request $request)
    {
        $nilai = Nilai::find($request->id_nilai);

        $nilai->nilai_absen = $request->get('nilai_absen');
        $nilai->nilai_tugas = $request->get('nilai_tugas');
        $nilai->nilai_uts = $request->get('nilai_uts');
        $nilai->nilai_uas = $request->get('nilai_uas');

        $nilai->save();

        return redirect()->route('admin.matakuliah.show', $matakuliah->id)->with('success', 'Nilai berhasil diedit');
    }

    /**
     * Add dosen to matakuliah.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addDosen(Matakuliah $matakuliah, MatakuliahDosenRequest $dosen)
    {
        try {
            Matakuliah::addDosen($matakuliah->id, $dosen->get('id_dosen'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.matakuliah.show', $matakuliah->id)->with('success', 'Dosen berhasil ditambahkan dari matakuliah');
    }

    /**
     * Remove dosen from matakuliah.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeDosen(Matakuliah $matakuliah, MatakuliahDosenRequest $dosen)
    {
        DB::table('matakuliah_dosen')
            ->where('id_matakuliah', $matakuliah->id)
            ->where('id_dosen', $dosen->get('id_dosen'))
            ->delete();

        return redirect()->route('admin.matakuliah.show', $matakuliah->id)->with('success', 'Dosen berhasil dihapus dari matakuliah');
    }
}
