<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Anda berhasil login.');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->with('error', 'Username atau password salah.');
    }

    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255', // Memperbaiki validasi
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), 
        ]);
        
        return redirect()->route('login')->with('success', 'Anda berhasil mendaftar, silakan login.');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}