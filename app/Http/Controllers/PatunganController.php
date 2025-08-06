<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patungan;

class PatunganController extends Controller
{
    public function index()
    {
        $patungan = Patungan::with(['komoditas', 'transaksi'])->get();
        $patungan->each(function ($item) {
            $item->total_terkumpul = $item->transaksi->sum('total_patungan');
            $item->presentase = $item->total_terkumpul / $item->total * 100;
            $item->total_transaksi = $item->transaksi->count();

        });

        return view('patungan.index', [
            'patungan' => $patungan->toArray()
        ]);
    }

    public function show($id)
    {
        $patungan = Patungan::with(['komoditas', 'transaksi'])->find($id);
        $patungan->total_terkumpul = $patungan->transaksi->sum('total_patungan');
        $patungan->presentase = $patungan->total_terkumpul / $patungan->total * 100;
        $patungan->total_transaksi = $patungan->transaksi->count();
        return view('patungan.detail', [
            'patungan' => $patungan->toArray()
        ]);
    }
}
