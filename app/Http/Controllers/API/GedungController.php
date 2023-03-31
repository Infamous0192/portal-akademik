<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GedungRequest;
use App\Models\Gedung;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gedung::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GedungRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GedungRequest $request)
    {
        $gedung = Gedung::create($request->all());

        return response()->json($gedung, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Gedung  $gedung
     * @return Gedung
     */
    public function show(Gedung $gedung)
    {
        return $gedung;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GedungRequest  $request
     * @param  Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(GedungRequest $request, Gedung $gedung)
    {
        $gedung->update($request->all());

        return response()->json($gedung, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gedung $gedung)
    {
        $gedung->delete();

        return response()->json(null, 204);
    }
}
