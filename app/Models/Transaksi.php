<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = ['id_transaksi'];

    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function patungan()
    {
        return $this->belongsTo(Patungan::class, 'id_patungan', 'id_patungan');
    }
}
