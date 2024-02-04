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
        Schema::create('brgkeluars', function (Blueprint $table) {
            $table->id();
            $table->string('id_pegawai');
            $table->string('kodebarang');
            $table->string('namabarang');
            $table->string('tokopemesan');
            $table->string('tanggal');
            $table->string('qty');
            $table->string('alamat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brgkeluars');
    }
};