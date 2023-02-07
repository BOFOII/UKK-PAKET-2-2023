<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Masyarakat extends User
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "masyarakat";
    protected $primaryKey = "nik";
    protected $keyType = "char";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        "nik",
        "nama",
        "username",
        "password",
        "telp"
    ];

    public function pengaduan() {
        return $this->hasMany(Pengaduan::class, "nik", "nik");
    }
}
