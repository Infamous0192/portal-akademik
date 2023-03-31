<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuanganRequest;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ruangan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RuanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuanganRequest $request)
    {
        $ruangan = Ruangan::create($request->all());

        return response()->json($ruangan, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Ruangan  $ruangan
     * @return Ruangan
     */
    public function show(Ruangan $ruangan)
    {
        return $ruangan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RuanganRequest  $request
     * @param  Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(RuanganRequest $request, Ruangan $ruangan)
    {
        $ruangan->update($request->all());

        return response()->json($ruangan, 200);
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

        return response()->json(null, 204);
    }
}
