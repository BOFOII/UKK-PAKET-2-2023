<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id("id_tanggapan");
            $table->foreignId("id_pengaduan")->references("id_pengaduan")->on("pengaduan");
            $table->date("tgl_tanggapan");
            $table->text("tanggapan");
            $table->foreignId("id_petugas")->references("id_petugas")->on("petugas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};
