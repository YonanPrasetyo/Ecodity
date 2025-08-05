<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $table = 'komoditas';
    protected $primaryKey = 'id_komoditas';
    protected $guarded = ['id_komoditas'];

    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = true;

    public function patungan()
    {
        return $this->hasMany(Patungan::class, 'id_komoditas', 'id_komoditas');
    }
}
