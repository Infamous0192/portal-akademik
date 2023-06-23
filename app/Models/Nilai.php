<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nilai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nilai_absen',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'id_mahasiswa',
        'id_krs',
        'id_matakuliah'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah');
    }

    public function krs()
    {
        return $this->belongsTo(Krs::class, 'id_krs');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
}
