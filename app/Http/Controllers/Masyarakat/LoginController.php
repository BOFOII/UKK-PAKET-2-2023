<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function index() {
        return view("masyarakat.login");
    }

    public function post(Request $request) {
        $request->validate([
            "username" => ["required", "max:25"],
            "password" => ["required", "max:32"]
        ]);

        $credential = $request->only(["username", "password"]);
        if(Auth::guard("msy")->attempt($credential)) {
            return redirect('/')->with("success", "Berhasil");
        }
        return back()->with("error", "Username / Password tidak ditemukan");
    }

    public function delete() {
        auth("msy")->logout();
        return back()->with("success", "Berhasil");
    }
}
