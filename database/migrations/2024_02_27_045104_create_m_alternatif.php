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
        Schema::create('m_alternatif', function (Blueprint $table) {
            $table->id('alternatif_id');
            $table->integer('periode_id')->index();
            $table->string('alternatif_nama', 100);
            $table->string('alternatif_nik', 100);
            $table->string('alternatif_alamat', 100);
            $table->string('RT', 50);
            $table->string('RW', 50);

            $table->foreign('periode_id')->references('periode_id')->on('m_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_alternatif');
    }
};
