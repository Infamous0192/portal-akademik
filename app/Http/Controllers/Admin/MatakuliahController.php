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
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Exception;
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
        $matakuliah = Matakuliah::all();

        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodi = Prodi::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->fakultas->nama . ')', 'value' => $item->id];
        });
        $ruangan = Ruangan::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->gedung->nama . ')', 'value' => $item->id];
        });

        return view('admin.matakuliah.create', compact('prodi', 'ruangan'));
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

        if (!Matakuliah::isRoomAvailable($request->get('hari'), $request->get('id_ruangan'), $waktu_mulai, $waktu_selesai)) {
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
        $prodi = Prodi::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->fakultas->nama . ')', 'value' => $item->id];
        });
        $ruangan = Ruangan::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->gedung->nama . ')', 'value' => $item->id];
        });

        $dosen = Dosen::select('dosen.nama', 'dosen.id', 'dosen.nip')
            ->where('id_prodi', $matakuliah->id_prodi)
            ->whereNotIn('id', DB::table('matakuliah_dosen')->select('id_dosen')->where('id_matakuliah', $matakuliah->id))
            ->get()->map(function ($item, $key) {
                return ['label' => $item->nama . ' (' . $item->nip . ')', 'value' => $item->id];
            });

        $akademik = TahunAkademik::orderBy('id', 'desc')->first();
        $nilai = Nilai::where('id_matakuliah', $matakuliah->id)
            ->whereIn('id_krs', Krs::select('id')->where('id_tahun_akademik', $akademik->id))->get();

        return view('admin.matakuliah.show', compact('matakuliah', 'prodi', 'ruangan', 'dosen', 'nilai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matakuliah $matakuliah)
    {
        $prodi = Prodi::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->fakultas->nama . ')', 'value' => $item->id];
        });
        $ruangan = Ruangan::all()->map(function ($item, $key) {
            return ['label' => $item->nama . ' (' . $item->gedung->nama . ')', 'value' => $item->id];
        });

        $dosen = Dosen::select('dosen.nama', 'dosen.id', 'dosen.nip')
            ->where('id_prodi', $matakuliah->id_prodi)
            ->whereNotIn('id', DB::table('matakuliah_dosen')->select('id_dosen')->where('id_matakuliah', $matakuliah->id))
            ->get()->map(function ($item, $key) {
                return ['label' => $item->nama . ' (' . $item->nip . ')', 'value' => $item->id];
            });

        return view('admin.matakuliah.show', compact('matakuliah', 'prodi', 'ruangan', 'dosen'));
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

        if (!Matakuliah::isRoomAvailable($request->get('hari'), $request->get('id_ruangan'), $waktu_mulai, $waktu_selesai, $matakuliah->id)) {
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
