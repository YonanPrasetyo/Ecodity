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
        Schema::create('patungan', function (Blueprint $table) {
            $table->id('id_patungan');
            $table->unsignedBigInteger('id_komoditas');
            $table->foreign('id_komoditas')->references('id_komoditas')->on('komoditas')->onDelete('cascade');
            $table->integer('total');
            $table->enum('status', ['dibuka', 'full', 'dikirim', 'di gudang'])->default('dibuka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patungan');
    }
};
