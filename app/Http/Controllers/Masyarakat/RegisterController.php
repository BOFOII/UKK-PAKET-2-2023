<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    public function index() {
        return view("masyarakat.register");
    }

    public function post(Request $request) {
        $request->validate([
            "nama" => ["required", "max:35"],
            "username" => ["required", "max:25"],
            "password" => ["required", "max:32"],
            "telp" => ["required", "max:13"]
        ]);

        Masyarakat::create([
            "nama" => $request->nama,
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "telp" => $request->telp
        ]);

        return redirect()->with("success", "Berhasil daftar");
    }
}
