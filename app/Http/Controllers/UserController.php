<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        try{
            $users = User::where('role', 'pengguna')->get(['id_user', 'nama', 'email', 'alamat']);
            return view('admin.user.index', [
                'users' => $users
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function registerForm()
    {
        return view('register');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        try {

            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'no_hp' => 'required|string|unique:users',
                'alamat' => 'required|string',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Register berhasil, Silahkan login.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route(Auth::user()->role . '.dashboard')->with('success', 'Login berhasil.');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'error' => $e]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }

}
