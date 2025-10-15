<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained()->onDelete('cascade');
            $table->integer('angsuran_ke');
            $table->decimal('jumlah_angsuran', 15, 2);
            $table->decimal('denda', 15, 2)->default(0);
            $table->decimal('total_bayar', 15, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['belum_bayar', 'lunas', 'telat'])->default('belum_bayar');
            $table->string('kode_transaksi')->unique()->nullable();
            $table->text('keterangan')->nullable();
            $table->string('metode_bayar')->default('tunai');
            $table->string('bukti_bayar')->nullable();
            $table->foreignId('diterima_oleh')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('angsuran');
    }
};