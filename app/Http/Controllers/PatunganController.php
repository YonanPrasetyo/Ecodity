<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patungan;
use App\Models\Komoditas;

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

        $komoditas = Komoditas::get(['id_komoditas', 'nama_komoditas']);

        return view('admin.patungan.index', [
            'patungan' => $patungan->toArray(),
            'komoditas' => $komoditas->toArray()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_komoditas' => 'required|exists:komoditas,id_komoditas',
                'total' => 'required|numeric',
            ]);

            $patungan = Patungan::create($request->all());
            return redirect()->route('admin.patungan.index')->with('success', 'Patungan berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $patungan = Patungan::with(['komoditas', 'transaksi'])->find($id);
        $patungan->total_terkumpul = $patungan->transaksi->sum('total_patungan');
        $patungan->presentase = $patungan->total_terkumpul / $patungan->total * 100;
        $patungan->total_transaksi = $patungan->transaksi->count();
        return view('admin.patungan.detail', [
            'patungan' => $patungan->toArray()
        ]);
    }

    public function indexPengguna()
    {
        $patungan = Patungan::with(['komoditas', 'transaksi'])->where('status', 'dibuka')->get();
        $patungan->each(function ($item) {
            $item->total_terkumpul = $item->transaksi->sum('total_patungan');
            $item->presentase = $item->total_terkumpul / $item->total * 100;
        });
        return view('pengguna.patungan.index', [
            'patungan' => $patungan->toArray()
        ]);
    }
}
