<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fakultas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'kode'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'id_fakultas', 'id');
    }
}
