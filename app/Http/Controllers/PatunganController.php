<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patungan;
use App\Models\Komoditas;

class PatunganController extends Controller
{
    public function index()
    {
        try {
            $patungan = Patungan::with(['komoditas', 'transaksi'])->where('status', '!=', 'selesai')->get();
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
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_komoditas' => 'required|exists:komoditas,id_komoditas',
                'total' => 'required|numeric',
            ]);

            $harga_total = $request->total * Komoditas::find($request->id_komoditas)->harga_per_satuan;

            do {
                $kode = date('ymdhis') . substr((string) microtime(true), -3);
            } while (Patungan::where('kode_patungan', $kode)->exists());

            $patungan = Patungan::create([
                'id_komoditas' => $request->id_komoditas,
                'total' => $request->total,
                'harga_total' => $harga_total,
                'kode_patungan' => $kode,
            ]);
            return redirect()->route('admin.patungan.index')->with('success', 'Patungan berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $patungan = Patungan::with(['komoditas', 'transaksi', 'transaksi.user'])->find($id);
            $patungan->total_terkumpul = $patungan->transaksi->sum('total_patungan');
            $patungan->presentase = $patungan->total_terkumpul / $patungan->total * 100;
            $patungan->total_transaksi = $patungan->transaksi->count();
            return view('admin.patungan.detail', [
                'patungan' => $patungan->toArray()
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function indexPengguna()
    {
        try {
            $patungan = Patungan::with(['komoditas', 'transaksi'])->where('status', 'dibuka')->get();
            $patungan->each(function ($item) {
                $item->total_terkumpul = $item->transaksi->sum('total_patungan');
                $item->presentase = $item->total_terkumpul / $item->total * 100;
            });
            return view('pengguna.patungan.index', [
                'patungan' => $patungan->toArray()
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pesan(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'bukti_pembelian' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $patungan = Patungan::find($id);

            $file = $request->file('bukti_pembelian');
            $fileName = "bukti_pembelian_" . $patungan->kode_patungan . "." . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads/' . 'bukti_pembelian', $fileName, 'public');

            $patungan->bukti_pembelian = $path;
            $patungan->status = 'dikirim';

            $patungan->save();

            return redirect()->back()->with('success', 'Patungan berhasil dipesan dan status diubah menjadi dikirim');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function kiriman()
    {
        try {
            $patungan = Patungan::with(['komoditas', 'transaksi'])->where('status', 'dikirim')->get();
            $patungan->each(function ($item) {
                $item->total_terkumpul = $item->transaksi->sum('total_patungan');
                $item->total_transaksi = $item->transaksi->count();
            });

            return view('gudang.kiriman.index', [
                'patungan' => $patungan->toArray()
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function datang($id)
    {
        try {
            $patungan = Patungan::find($id);
            $patungan->status = 'di gudang';
            $patungan->save();

            $transaksi = $patungan->transaksi;
            foreach ($transaksi as $item) {
                $item->status = 'di gudang';
                $item->save();
            }

            return redirect()->back()->with('success', 'Patungan berhasil diterima dan status diubah menjadi di gudang');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function riwayat()
    {
        try {
            $patungan = Patungan::with(['komoditas', 'transaksi'])->where('status', 'selesai')->get();
            $patungan->each(function ($item) {
                $item->total_terkumpul = $item->transaksi->sum('total_patungan');
                $item->presentase = $item->total_terkumpul / $item->total * 100;
                $item->total_transaksi = $item->transaksi->count();
            });

            $komoditas = Komoditas::get(['id_komoditas', 'nama_komoditas']);

            return view('admin.riwayat.index', [
                'patungan' => $patungan->toArray(),
                'komoditas' => $komoditas->toArray()
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
