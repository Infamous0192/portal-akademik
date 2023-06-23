<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Krs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'krs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'id_mahasiswa', 'id_matakuliah', 'id_tahun_akademik'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_krs');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah');
    }

    public static function isScheduleConflict($id_mahasiswa, $id_matakuliah)
    {
        $matakuliah = DB::table('matakuliah')
            ->select('hari', 'waktu_mulai', 'waktu_selesai')
            ->where('id', $id_matakuliah)
            ->first();

        $conflictingKrs = DB::table('krs AS k')
            ->select('m.hari', 'm.waktu_mulai', 'm.waktu_selesai')
            ->join('nilai AS n', 'k.id', '=', 'n.id_krs')
            ->join('matakuliah AS m', 'n.id_matakuliah', '=', 'm.id')
            ->where('k.id_mahasiswa', $id_mahasiswa)
            ->where('k.status', 'pending')
            ->where(function ($query) use ($matakuliah) {
                $query->where('m.hari', $matakuliah->hari)
                    ->where(function ($query) use ($matakuliah) {
                        $query->where('m.waktu_mulai', '<=', $matakuliah->waktu_selesai)
                            ->where('m.waktu_selesai', '>=', $matakuliah->waktu_mulai);
                    });
            })
            ->first();

        return $conflictingKrs !== null;
    }
}
