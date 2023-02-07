<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{

    public function index(Request $request)
    {
        $pengaduans = Pengaduan::where("nik", auth("msy")->user()->nik)->with("tanggapan")->get();

        // JIKA ADA ID PADA ROUTE "/"
        if($request->route()->hasParameter("id")) {
            $pengaduan = Pengaduan::findOrFail($request->route()->parameter("id"));
            return view('masyarakat.pengaduan', compact('pengaduans', 'pengaduan'));
        }

        // JIKA TIDAK
        return view('masyarakat.pengaduan', compact('pengaduans'));
    }

    public function post(Request $request)
    {
        $request->validate([
            "tgl_pengaduan" => ["date", "nullable"],
            "isi_laporan" => ["required", "string"],
            "foto" => ["required", "file", "mimes:png,jpg"]
        ]);

        $upload = $request->file("foto")->store("images", "public");
        Pengaduan::create([
            "tgl_pengaduan" => $request->tgl_pengaduan,
            "isi_laporan" => $request->isi_laporan,
            "foto" => Storage::disk("public")->url($upload),
            "nik" => auth("msy")->user()->nik
        ]);

        return back()->with("success", "Berhasil");
    }

    public function patch(Request $request) {
        $request->validate([
            "tgl_pengaduan" => ["date", "nullable"],
            "isi_laporan" => ["nullable", "string"],
            "foto" => ["nullable", "file", "mimes:png,jpg"]
        ]);

        $pengaduan = Pengaduan::find($request->route()->parameter("id"));

        if($request->has("foto")) {
            $upload = $request->file("foto")->store("images", "public");
            $pengaduan->foto = Storage::disk("public")->url($upload);
        }

        $pengaduan->update(array_filter($request->only([
            "tgl_pengaduan",
            "isi_laporan"
        ])));

        return back()->with("success", "Berhasil");
    }

    public function destroy(Request $request)
    {
        Pengaduan::find($request->route()->parameter("id"))->delete();
        return back()->with("success", "Berhasil");
    }
}
