<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gedung';

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

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class);
    }
}
