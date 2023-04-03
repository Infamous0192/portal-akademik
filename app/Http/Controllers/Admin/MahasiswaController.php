<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Krs;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\TahunAkademik;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodi = Prodi::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.mahasiswa.create', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MahasiswaRequest $request)
    {
        $filename = Str::uuid() . '.' . $request->file('foto')->extension();
        $path = "/uploads/$filename";
        $request->file('foto')->move(public_path('uploads'), $filename);

        $user = User::create([
            'nama' => $request->get('nama'),
            'username' => $request->get('nim'),
            'password' => $request->get('nim'),
            'role' => 'mahasiswa',
        ]);

        $prodi = Prodi::find($request->get('id_prodi'));

        Mahasiswa::create([
            ...$request->except('foto'),
            'foto' => $path,
            'id_fakultas' => $prodi->id_fakultas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
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

        return view('admin.mahasiswa.show', compact('mahasiswa', 'nilai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodi = Prodi::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MahasiswaRequest $request, $id)
    {
        $data = $request->except(['foto']);

        if ($request->file('foto') != null) {
            $filename = Str::uuid() . '.' . $request->file('foto')->extension();
            $request->file('foto')->move(public_path('uploads'), $filename);
            $path = "/uploads/$filename";
            $data['foto'] = $path;
        }

        $prodi = Prodi::find($request->get('id_prodi'));
        $data['id_fakultas'] = $prodi->id_fakultas;

        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            ...$data,
        ]);

        return redirect()->route('admin.mahasiswa.show', $id)->with('success', 'Mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
