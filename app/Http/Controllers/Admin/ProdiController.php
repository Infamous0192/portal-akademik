<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdiRequest;
use App\Models\Fakultas;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();

        return view('admin.prodi.index', compact('prodi', 'fakultas'));
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

        return view('admin.prodi.create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdiRequest $request)
    {
        Prodi::create($request->validated());

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        $fakultas = Fakultas::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.prodi.show', compact('prodi', 'fakultas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.prodi.show', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdiRequest $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->validated());

        return redirect()->route('admin.prodi.show', $id)->with('success', 'Program studi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect()->route('admin.prodi.index')->with('success', 'Program studi berhasil dihapus');
    }
}
