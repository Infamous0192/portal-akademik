<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'no_telepon',
        'foto',
        'id_prodi',
        'id_fakultas',
        'id_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
