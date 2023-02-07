<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller {

    public function index(Request $request) {
        $pengaduan = Pengaduan::with("tanggapan.petugas")->findOrFail($request->route()->parameter("id"));
        return view("masyarakat.tanggapan", compact('pengaduan'));
    }
}
