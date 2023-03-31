<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('ruangan', 'id_ruangan');
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'matakuliah_dosen', 'id_matakuliah', 'id_dosen');
    }
}
