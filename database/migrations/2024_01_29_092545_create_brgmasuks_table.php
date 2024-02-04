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
        Schema::create('brgmasuks', function (Blueprint $table) {
            $table->id();
            $table->string('kodebarang');
            $table->string('id_supplier');
            $table->string('namabarang');
            $table->string('qty');
            $table->string('tanggal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brgmasuks');
    }
};
