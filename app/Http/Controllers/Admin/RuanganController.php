<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuanganRequest;
use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();

        return view('admin.ruangan.index', compact('ruangan', 'gedung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gedung = Gedung::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.ruangan.create', compact('gedung'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuanganRequest $request)
    {
        Ruangan::create($request->validated());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        $gedung = Gedung::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.ruangan.show', compact('ruangan', 'gedung'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        $gedung = Gedung::all()->map(function ($item, $key) {
            return ['label' => $item->nama, 'value' => $item->id];
        });

        return view('admin.ruangan.show', compact('ruangan', 'gedung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RuanganRequest $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->validated());

        return redirect()->route('admin.ruangan.show', $id)->with('success', 'Ruangan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
