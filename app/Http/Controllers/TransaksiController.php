<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Patungan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'total_patungan' => 'required|numeric',
            'opsi_pengiriman' => 'required|in:dikirim,diambil,diinapkan',
        ]);

        $transaksi = Transaksi::create([
            'id_patungan' => $request->id_patungan,
            'id_user' => $request->id_user,
            'total_patungan' => $request->total_patungan,
            'opsi_pengiriman' => $request->opsi_pengiriman,
        ]);

        if ($request->total_patungan == $request->sisa) {
            Patungan::where('id_patungan', $request->id_patungan)->update(['status' => 'full']);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil.');
    }

    public function barang()
    {

        $transaksi = Transaksi::
                        with(['user', 'patungan', 'patungan.komoditas'])
                        ->whereHas('patungan', function ($query) {
                            $query->where('status', 'di gudang');
                        })
                        ->get();

        return view('gudang.barang.index', [
            'transaksi' => $transaksi
        ]);
    }
}
