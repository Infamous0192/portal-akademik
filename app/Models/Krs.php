<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function akademik() {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
}
