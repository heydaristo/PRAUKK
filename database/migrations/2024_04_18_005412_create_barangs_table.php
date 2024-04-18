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
        Schema::create('barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_brg')->length(6)->primary();
            $table->string('nama_brg')->length(100);
            $table->string('merk')->length(30);
            $table->unsignedBigInteger('harga')->length(10);
            $table->integer('jumlah')->length(4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
