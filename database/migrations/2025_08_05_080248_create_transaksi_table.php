<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_patungan');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_patungan')->references('id_patungan')->on('patungan')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->integer('total_patungan');
            $table->enum('opsi_pengiriman', ['dikirim', 'diambil', 'diinapkan']);
            $table->enum('status', ['belum', 'dikirim', 'selesai', 'di gudang'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
