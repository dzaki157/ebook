<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register'); // Ganti dengan view pendaftaran yang sesuai
    }

    // Proses pendaftaran pengguna
    public function register(Request $request)
    {
        // Validasi data yang diterima
        $this->validator($request->all())->validate();

        // Membuat pengguna baru
        $user = $this->create($request->all());

        // Login pengguna setelah pendaftaran
        Auth::login($user);

        // Redirect setelah registrasi
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    // Metode untuk validasi input pengguna
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // pastikan ada password_confirmation
        ]);
    }

    // Metode untuk membuat pengguna baru
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    
}
