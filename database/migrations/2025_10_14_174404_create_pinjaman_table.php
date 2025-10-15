<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained()->onDelete('cascade');
            $table->string('kode_pinjaman')->unique();
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->decimal('bunga', 5, 2);
            $table->integer('tenor'); // dalam bulan
            $table->decimal('angsuran_per_bulan', 15, 2);
            $table->decimal('total_pinjaman', 15, 2);
            $table->text('tujuan_pinjaman');
            $table->enum('status', ['pengajuan', 'disetujui', 'ditolak', 'aktif', 'lunas', 'macet'])->default('pengajuan');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_disahkan')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users');
            $table->text('catatan_admin')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->string('penjamin')->nullable();
            $table->string('kontak_penjamin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
};