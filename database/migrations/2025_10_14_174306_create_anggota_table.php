<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('kode_anggota')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nik', 16)->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('status_perkawinan', ['belum_menikah', 'menikah', 'cerai']);
            $table->string('pekerjaan');
            $table->string('alamat_ktp');
            $table->string('alamat_domisili')->nullable();
            $table->string('nama_ibu_kandung');
            $table->string('referensi')->nullable();
            $table->enum('status_anggota', ['aktif', 'non-aktif', 'diblokir'])->default('aktif');
            $table->date('tanggal_daftar');
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota');
    }
};