<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAkademikRequest;
use App\Models\Jadwal;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_akademik = TahunAkademik::all();
        $jadwal = Jadwal::orderBy('created_at', 'DESC')->first();

        return view('admin.tahun_akademik.index', compact('tahun_akademik', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tahun_akademik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TahunAkademikRequest $request)
    {
        TahunAkademik::create($request->validated());

        return redirect()->route('admin.tahun_akademik.index')->with('success', 'Tahun akademik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAkademik $tahun_akademik)
    {
        return view('admin.tahun_akademik.show', compact('tahun_akademik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAkademik $tahun_akademik)
    {
        return view('admin.tahun_akademik.show', compact('tahun_akademik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahunAkademikRequest $request, $id)
    {
        $tahun_akademik = TahunAkademik::findOrFail($id);
        $tahun_akademik->update($request->validated());

        return redirect()->route('admin.tahun_akademik.show', $id)->with('success', 'Tahun akademik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAkademik $tahun_akademik)
    {
        $tahun_akademik->delete();

        return redirect()->route('admin.tahun_akademik.index')->with('success', 'Tahun akademik berhasil dihapus');
    }

    public function upload(Request $request)
    {
        $data = $request->validate([
            'file' => [
                'required',
                File::types(['pdf'])
            ]
        ]);

        $filename = Str::uuid() . '.' . $data['file']->extension();
        $path = "/uploads/$filename";
        $data['file']->move(public_path('uploads'), $filename);

        Jadwal::create([
            'file' => $path,
        ]);

        return redirect()->route('admin.tahun_akademik.index')->with('success', 'Jadwal berhasil diupload');
    }
}
