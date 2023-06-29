<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Matakuliah;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::all();
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();

        return view('admin.dosen.index', compact('dosen', 'fakultas', 'prodi'));
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

        return view('admin.dosen.create', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DosenRequest $request)
    {
        $filename = Str::uuid() . '.' . $request->file('foto')->extension();
        $path = "/uploads/$filename";
        $request->file('foto')->move(public_path('uploads'), $filename);

        $user = User::create([
            'nama' => $request->get('nama'),
            'username' => $request->get('nip'),
            'password' => $request->get('nip'),
            'role' => 'dosen',
        ]);

        $prodi = Prodi::find($request->get('id_prodi'));

        Dosen::create([
            ...$request->except('foto'),
            'foto' => $path,
            'id_fakultas' => $prodi->id_fakultas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        $matakuliah = Matakuliah::whereIn('id', DB::table('matakuliah_dosen')->select('id_matakuliah')->where('id_dosen', $dosen->id))->get();

        return view('admin.dosen.show', compact('dosen', 'matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $prodi = Prodi::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.dosen.edit', compact('dosen', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DosenRequest $request, $id)
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

        $dosen = Dosen::findOrFail($id);

        $dosen->update([
            ...$data,
        ]);

        return redirect()->route('admin.dosen.show', $id)->with('success', 'Dosen berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}
