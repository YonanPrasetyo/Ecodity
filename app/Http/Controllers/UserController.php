<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'pengguna')->get(['id_user', 'nama', 'email', 'alamat']);
        return view('user.index', [
            'users' => $users
        ]);
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'alamat' => 'required|string',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Register berhasil.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function login(Request $Requset)
    {
        try {
            $Requset->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            if (auth()->attempt($Requset->only('email', 'password'))) {
                return redirect()->route('user.index')->with('success', 'Login berhasil.');
            }

            return redirect()->back()->with('error', 'Email atau password salah.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
