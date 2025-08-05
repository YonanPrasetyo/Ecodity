<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patungan extends Model
{
    protected $table = 'patungan';
    protected $primaryKey = 'id_patungan';
    protected $guarded = ['id_patungan'];

    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = true;

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 'id_komoditas', 'id_komoditas');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_patungan', 'id_patungan');
    }
}
