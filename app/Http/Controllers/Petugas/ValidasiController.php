<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class ValidasiController extends Controller {

    public function index() {
        $pengaduans = Pengaduan::with('masyarakat')->get();
        return view("petugas.validasi", compact('pengaduans'));
    }

    public function post(Request $request) {
        $request->validate([
            "id_pengaduan" => ["required", "integer"],
            "status" => ["required"]
        ]);

        Pengaduan::find($request->id_pengaduan)->update([
            "status" => $request->status,
        ]);

        return back()->with("success", "Berhasil");
    }

    public function destroy(Request $request) {
        Pengaduan::find($request->route()->parameter("id"))->delete();
        return back()->with("success", "Berhasil");
    }
}
