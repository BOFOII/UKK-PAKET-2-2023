<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends User
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "petugas";
    protected $primaryKey = "id_petugas";
    public $timestamps = false;
    protected $fillable  = [
        "nama_petugas",
        "username",
        "password",
        "telp",
        "level"
    ];

    public function tanggapan() {
        return $this->hasMany(Tanggapan::class, "id_petugas", "id_petugas");
    }
}
