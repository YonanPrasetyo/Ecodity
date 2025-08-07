<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komoditas;

class KomoditasController extends Controller
{
    public function index()
    {
        $komoditas = Komoditas::all();
        return view('admin.komoditas.index', [
            'komoditas' => $komoditas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_komoditas' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_per_satuan' => 'required|numeric',
            'pabrik' => 'required|string|max:255'
        ]);

        $komoditas = Komoditas::create($request->all());

        return redirect()->back()->with('success', 'Komoditas Berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
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
    }

    public function delete($id)
    {
        $komoditas = Komoditas::where('id_komoditas', $id)->delete();
        return redirect()->back()->with('success', 'Komoditas Berhasil dihapus.');
    }
}
