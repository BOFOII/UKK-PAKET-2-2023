<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengaduanExport implements FromCollection {

    private $fromDate = null;
    private $toDate = null;

    public function __construct($fromDate, $toDate) {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function collection() : Collection {
        // return
        if($this->fromDate !== null && $this->toDate) {
            return $this->scopeDateBetween();
        }
        return Pengaduan::all();
    }

    public function scopeDateBetween() : Collection {
        return Pengaduan::whereBetween("tgl_pengaduan", [$this->fromDate, $this->toDate])->get();
    }

}
