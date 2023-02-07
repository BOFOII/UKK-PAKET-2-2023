<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller {

    public function index(Request $request) {
        $pengaduans = Pengaduan::with('masyarakat')->where("status", "proses")->get();
        $tanggapans = Tanggapan::with("pengaduan")->where("id_petugas", auth("petugas")->user()->id_petugas)->get();

        if($request->route()->hasParameter("id")) {
            $tanggapan = Tanggapan::findOrFail($request->route()->parameter("id"));
            return view("petugas.tanggapan", compact("pengaduans", "tanggapans", "tanggapan"));
        }

        return view("petugas.tanggapan", compact("pengaduans", "tanggapans"));
    }

    public function post(Request $request) {
        $request->validate([
            "id_pengaduan" => ["required", "integer"],
            "tgl_tanggapan" => ["required", "date"],
            "tanggapan" => ["required", "string"],
        ]);

        Tanggapan::create([
            "id_pengaduan" => $request->id_pengaduan,
            "tgl_tanggapan" => $request->tgl_tanggapan,
            "tanggapan" => $request->tanggapan,
            "id_petugas" => auth("petugas")->user()->id_petugas
        ]);

        return back()->with("success", "Berhasil");
    }

    public function patch(Request $request) {
        $request->validate([
            "id_pengaduan" => ["nullable", "integer"],
            "tgl_tanggapan" => ["nullable", "date"],
            "tanggapan" => ["nullable", "string"],
        ]);

        $tanggapan = Tanggapan::find($request->route()->parameter("id"));
        $tanggapan->update(array_filter($request->only([
            "tgl_tanggapan",
            "tanggapan"
        ])));
        return back()->with("success", "Berhasil");
    }

    public function destroy(Request $request) {
        Tanggapan::find($request->route()->parameter("id"))->delete();
        return back()->with("success", "Berhasil");
    }
}
