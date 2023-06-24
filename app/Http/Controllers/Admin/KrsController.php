<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Nilai;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $krs = Krs::where('status', 'process')->get();

        return view('admin.krs.index', compact('krs'));
    }

    /**
     * Show KRS.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Krs $krs)
    {
        $matakuliah = Matakuliah::whereIn('id', Nilai::select('id_matakuliah')->where('id_krs', $krs->id))->get();
        $total_sks = 0;

        foreach ($matakuliah as $item) {
            $total_sks += $item->sks;
        }

        return view('admin.krs.show', compact('krs', 'matakuliah', 'total_sks'));
    }

    /**
     * Reject KRS.
     *
     * @return \Illuminate\Http\Response
     */
    public function reject(Krs $krs)
    {
        $krs->status = 'rejected';
        $krs->save();

        // Nilai::where('id_krs', $krs->id)->delete();

        return redirect()->route('admin.krs.index')->with('success', 'KRS berhasil ditolak');
    }

    /**
     * Reject KRS.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept(Krs $krs)
    {
        $krs->status = 'accepted';
        $krs->save();

        return redirect()->route('admin.krs.index')->with('success', 'KRS berhasil disetujui');
    }
}
