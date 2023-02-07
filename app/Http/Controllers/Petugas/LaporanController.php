<?php

namespace App\Http\Controllers\Petugas;

use App\Exports\PengaduanExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller {

    public function index() {
        return view('petugas.laporan');
    }

    public function post(Request $request) {
        $request->validate([
            "fromdate" => ["nullable", "date"],
            "todate" => ["nullable", "date"],
            "type" => ["required"]
        ]);

        $type = $request->type == "excel" ? ".xlsx" : ".pdf";
        $classType = $request->type == "excel" ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::MPDF;
        return Excel::download(new PengaduanExport($request->fromdate, $request->todate), uniqid("laoporan") . $type, $classType);
    }
}
