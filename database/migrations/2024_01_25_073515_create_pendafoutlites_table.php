<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendafoutlites', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('id_sales');
            $table->string('kodetoko');
            $table->string('namatoko');
            $table->string('pemiliktoko');
            $table->string('domisili');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('fotoktp');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendafoutlites');
    }
};
