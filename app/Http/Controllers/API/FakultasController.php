<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Fakultas::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FakultasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FakultasRequest $request)
    {
        $fakultas = Fakultas::create($request->all());

        return response()->json($fakultas, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Fakultas  $fakultas
     * @return Fakultas
     */
    public function show(Fakultas $fakultas)
    {
        return $fakultas;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FakultasRequest  $request
     * @param  Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(FakultasRequest $request, Fakultas $fakultas)
    {
        $fakultas->update($request->all());

        return response()->json($fakultas, 200);
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

        return response()->json(null, 204);
    }
}
