<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakultas = Fakultas::all();

        return view('admin.fakultas.index', compact('fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FakultasRequest $request)
    {
        Fakultas::create($request->validated());

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fakultas $fakultas)
    {
        $matakuliah = Matakuliah::where('id_fakultas', $fakultas->id)->get();

        return view('admin.fakultas.show', compact('fakultas', 'matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fakultas $fakultas)
    {
        return view('admin.fakultas.show', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FakultasRequest $request, $id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->update($request->validated());

        return redirect()->route('admin.fakultas.show', $id)->with('success', 'Fakultas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil dihapus');
    }
}
