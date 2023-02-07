<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function index(Request $request)
    {
        $staffs = Petugas::all();

        if($request->route()->hasParameter("id")) {
            $petugas = Petugas::findOrFail($request->route()->parameter("id"));
            return view("petugas.reigster", compact('staffs', 'petugas'));
        }

        return view("petugas.reigster", compact('staffs'));
    }

    public function post(Request $request)
    {
        $request->validate([
            "nama_petugas" => ['required', 'max:35', 'string'],
            "username" => ['required', 'max:25', 'string'],
            "password" => ['required', 'max:32', 'string'],
            "telp" => ['required', 'max:13'],
            "level" => ['required', 'string']
        ]);

        Petugas::create([
            "nama_petugas" => $request->nama_petugas,
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "telp" => $request->telp,
            "level" => $request->level
        ]);

        return back()->with("success", "Berhasil");
    }

    public function patch(Request $request)
    {
        $request->validate([
            "nama_petugas" => ['nullable', 'max:35', 'string'],
            "username" => ['nullable', 'max:25', 'string'],
            "password" => ['nullable', 'max:32', 'string'],
            "telp" => ['nullable', 'max:13'],
            "level" => ['nullable', 'string']
        ]);

        $petugas = Petugas::find($request->route()->parameter("id"));
        if($request->has("password") || $request->password != null || $request->password != "") {
            $petugas->password = Hash::make($request->password);
        }

        $petugas->update(array_filter($request->only([
            "nama_petugas",
            "username",
            "telp",
            "level",
        ])));

        return back()->with("success", "Berhasil");
    }

    public function destroy(Request $request)
    {
        Petugas::find($request->route()->parameter("id"))->delete();
        return back()->with("success", "Berhasil");
    }
}
