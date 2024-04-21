<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return redirect()->route('client.index');
        }else{
            return view('session.login');
        }
    }

    public function actionlogin(Request $request) {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            // dd(Auth::check());
            return redirect()->route('client.index');
        }else{
            // Session::flash('error', 'Email atau Password Salah');
            return redirect()->route('login')->with('error', 'Email atau Password Salah');
        }
    }

    public function register() {
        return view('session.register');
    }

    public function create(Request $request) {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);

        $request->validate([
            'email' =>'email|unique:users',
            'password' => 'min:8'
        ], [
            'email.email' => 'Masukkan email yang valid!',
            'email.unique' => 'Email sudah digunakan, silahkan masukkan email lain!',
            'password' => 'Karakter password minimal harus 8 karakter!'
        ]);

        $registerinfo = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => 3,
        ];

        User::create($registerinfo);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silahkan log in!');
    }

    public function actionlogout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
