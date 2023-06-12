<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Matakuliah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matakuliah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kode',
        'sks',
        'semester',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'kategori',
        'id_prodi',
        'id_ruangan',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function prodi()
    {
        return $this->belongsTo('prodi', 'id_prodi');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'matakuliah_dosen', 'id_matakuliah', 'id_dosen');
    }

    public static function isScheduleAvailable($hari, $waktu_mulai, $waktu_selesai)
    {
        $query = DB::table('matakuliah')
            ->select(DB::raw('COUNT(*) as conflicts'))
            ->where('hari', '=', $hari)
            ->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                $query->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '<=', $waktu_mulai)
                        ->where('waktu_selesai', '>=', $waktu_mulai);
                })->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '<=', $waktu_selesai)
                        ->where('waktu_selesai', '>=', $waktu_selesai);
                })->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '>=', $waktu_mulai)
                        ->where('waktu_selesai', '<=', $waktu_selesai);
                });
            });

        return $query->first()->conflicts == 0;
    }

    public static function isRoomAvailable($hari, $ruangan, $waktu_mulai, $waktu_selesai, $id = null)
    {
        $query = DB::table('matakuliah')
            ->select(DB::raw('COUNT(*) as room_usage'))
            ->where('id_ruangan', '=', $ruangan)
            ->where('hari', '=', $hari)
            ->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                $query->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '<=', $waktu_selesai)
                        ->where('waktu_selesai', '>=', $waktu_mulai);
                })->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '>=', $waktu_mulai)
                        ->where('waktu_mulai', '<=', $waktu_selesai);
                });
            });

        if ($id != null) {
            $query->where('id', '!=', $id);
        }

        return $query->first()->room_usage == 0;
    }
}
