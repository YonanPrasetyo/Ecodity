<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use App\Models\Patungan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'total_patungan' => 'required|numeric',
                'opsi_pengiriman' => 'required|in:dikirim,diambil,diinapkan',
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $diinapkan = false;
            if($request->diinapkan) {
                $diinapkan = true;
            }

            do {
                $kode = date('ymdhis') . substr((string) microtime(true), -3);
            } while (Patungan::where('kode_patungan', $kode)->exists());

            $file = $request->file('bukti_pembayaran');
            $fileName = "bukti_pembayaran_" . $kode . "." . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads/' . 'bukti_pembayaran', $fileName, 'public');

            $transaksi = Transaksi::create([
                'id_patungan' => $request->id_patungan,
                'id_user' => $request->id_user,
                'total_patungan' => $request->total_patungan,
                'opsi_pengiriman' => $request->opsi_pengiriman,
                'kode_transaksi' => $kode,
                'diinapkan' => $diinapkan,
                'bukti_pembayaran' => $path
            ]);

            if ($request->total_patungan == $request->sisa) {
                Patungan::where('id_patungan', $request->id_patungan)->update(['status' => 'full']);
            }

            return redirect()->back()->with('success', 'Transaksi berhasil.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function barang()
    {
        try {
            $transaksi = Transaksi::
                            with(['user', 'patungan', 'patungan.komoditas'])
                            ->whereHas('patungan', function ($query) {
                                $query->where('status', 'di gudang');
                            })->where('status', '!=', 'selesai')
                            ->get();

            return view('gudang.barang.index', [
                'transaksi' => $transaksi
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function diambil($id)
    {
        try {
            $transaksi = Transaksi::find($id);
            $transaksi->status = 'selesai';
            $transaksi->save();

            $idPatungan = $transaksi->id_patungan;

            $semuaSelesai = Transaksi::where('id_patungan', $idPatungan)
                ->where('status', '!=', 'selesai')
                ->doesntExist();

            if ($semuaSelesai) {
                $patungan = Patungan::find($idPatungan);
                $patungan->status = 'selesai';
                $patungan->save();
            }


            return redirect()->back()->with('success', 'barang sudah diambil');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function dikirim($id)
    {
        try {
            $transaksi = Transaksi::find($id);
            $transaksi->status = 'dikirim';
            $transaksi->save();

            return redirect()->back()->with('success', 'barang sedang dikirim');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function kembali($id)
    {
        try {
            $transaksi = Transaksi::find($id);
            $transaksi->status = 'di gudang';
            $transaksi->save();

            return redirect()->back()->with('success', 'barang gagal dikirim dan dikembalikan ke gudang');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        try {
            $transaksi = Transaksi::with(['patungan.komoditas', 'user'])
                                    ->where('status', '!=', 'selesai')
                                    ->where('id_user', Auth::user()->id_user)
                                    ->get();

            return view('pengguna.transaksi.index', [
                'transaksi' => $transaksi
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function invoice($id)
    {
        try {
            $transaksi = Transaksi::with(['patungan.komoditas', 'user'])->find($id);

            $pdf = Pdf::loadView('pdf.invoice', [
                'transaksi' => $transaksi
            ])->setPaper('a4', 'portrait');

            return $pdf->stream('invoice.pdf');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function riwayat()
    {
        try {
            $transaksi = Transaksi::with(['patungan.komoditas', 'user'])
                                    ->where('status', 'selesai')
                                    ->where('id_user', Auth::user()->id_user)
                                    ->get();

            return view('pengguna.riwayat.index', [
                'transaksi' => $transaksi
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
