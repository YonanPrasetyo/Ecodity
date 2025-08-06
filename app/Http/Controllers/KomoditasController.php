<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komoditas;

class KomoditasController extends Controller
{
    public function index()
    {
        $komoditas = Komoditas::all();
        return view('komoditas.index', [
            'komoditas' => $komoditas
        ]);
    }
}
