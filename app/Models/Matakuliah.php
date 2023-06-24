<?php

namespace App\Models;

use Exception;
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
        'id_fakultas',
        'id_ruangan',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'matakuliah_dosen', 'id_matakuliah', 'id_dosen');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_matakuliah');
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

    public static function addDosen($id_matakuliah, $id_dosen)
    {
        $matakuliah = DB::table('matakuliah')->where('id', $id_matakuliah)->first();
        $waktu_mulai = $matakuliah->waktu_mulai;
        $waktu_selesai = $matakuliah->waktu_selesai;

        $query = DB::table('matakuliah_dosen AS md')
            ->select(DB::raw('COUNT(*) as availability'))
            ->join('matakuliah AS m', 'md.id_matakuliah', '=', 'm.id')
            ->where('md.id_dosen', '=', $id_dosen)
            ->where('m.hari', '=', $matakuliah->hari)
            ->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                $query->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('m.waktu_mulai', '<=', $waktu_selesai)
                        ->where('m.waktu_selesai', '>=', $waktu_mulai);
                })->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('m.waktu_mulai', '>=', $waktu_mulai)
                        ->where('m.waktu_mulai', '<=', $waktu_selesai);
                });
            });

        $isAvailable = $query->first()->availability == 0;
        if (!$isAvailable) {
            throw new Exception('Dosen tidak tersedia');
        }

        DB::table('matakuliah_dosen')->insert([
            'id_matakuliah' => $matakuliah->id,
            'id_dosen' => $id_dosen,
        ]);
    }
}
