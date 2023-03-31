<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdiRequest;
use App\Models\Prodi;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Prodi::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProdiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdiRequest $request)
    {
        $prodi = Prodi::create($request->all());

        return response()->json($prodi, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Prodi  $prodi
     * @return Prodi
     */
    public function show(Prodi $prodi)
    {
        return $prodi;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProdiRequest  $request
     * @param  Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(ProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->all());

        return response()->json($prodi, 200);
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

        return response()->json(null, 204);
    }
}
