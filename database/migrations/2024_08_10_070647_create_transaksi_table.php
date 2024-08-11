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
            $table->id();
            $table->string('rekam');
            $table->string('pasien');
            $table->string('shift');
            $table->string('type');
            $table->string('md');
            $table->string('nurse1')->nullable();
            $table->string('nurse2')->nullable();
            $table->string('overtime')->nullable();
            $table->string('driver')->nullable();
            $table->string('lokasi')->default('Jl Batu Belig No 199, Kerobokan Kelod, Kuta Utara');
            $table->string('pembayaran');
            $table->string('admin');
            $table->string('bill');
            $table->string('lab_bill');
            $table->string('total');
            $table->string('input');
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
