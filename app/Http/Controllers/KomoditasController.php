<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komoditas;

class KomoditasController extends Controller
{
    public function index()
    {
        try {
            $komoditas = Komoditas::all();
            return view('admin.komoditas.index', [
                'komoditas' => $komoditas
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_komoditas' => 'required|string|max:255',
                'satuan' => 'required|string|max:255',
                'harga_per_satuan' => 'required|numeric',
                'pabrik' => 'required|string|max:255'
            ]);

            $komoditas = Komoditas::create($request->all());

            return redirect()->back()->with('success', 'Komoditas Berhasil ditambahkan.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_komoditas' => 'required|string|max:255',
                'satuan' => 'required|string|max:255',
                'harga_per_satuan' => 'required|numeric',
                'pabrik' => 'required|string|max:255'
            ]);

            $komoditas = Komoditas::where('id_komoditas', $id)->update([
                'nama_komoditas' => $request->nama_komoditas,
                'satuan' => $request->satuan,
                'harga_per_satuan' => $request->harga_per_satuan,
                'pabrik' => $request->pabrik
            ]);

            return redirect()->back()->with('success', 'Komoditas Berhasil dirubah.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $komoditas = Komoditas::where('id_komoditas', $id)->delete();
            return redirect()->back()->with('success', 'Komoditas Berhasil dihapus.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
