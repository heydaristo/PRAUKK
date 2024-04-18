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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_transaksi')->primary();
            $table->unsignedBigInteger('kode_brg')->length(6);
            $table->foreign('kode_brg')->references('kode_brg')->on('barangs');
            $table->string('nama_brg')->length(60);
            $table->unsignedBigInteger('harga')->length(10);
            $table->integer('jumlah')->length(4);
            $table->unsignedBigInteger('total_bayar')->length(10);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
