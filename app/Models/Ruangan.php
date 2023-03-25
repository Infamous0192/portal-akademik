<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ruangan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'kode', 'id_gedung'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'id_gedung', 'id');
    }
}
