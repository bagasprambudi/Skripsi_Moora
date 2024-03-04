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
        Schema::create('t_penilaian', function (Blueprint $table) {
            $table->id('penilaian_id');
            $table->unsignedBigInteger('alternatif_id')->index();
            $table->unsignedBigInteger('kriteria_id')->index();
            $table->integer('periode_id')->index();
            $table->integer('nilai');

            $table->foreign('alternatif_id')->references('alternatif_id')->on('m_alternatif');
            $table->foreign('kriteria_id')->references('kriteria_id')->on('m_kriteria');
            $table->foreign('periode_id')->references('periode_id')->on('m_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penilaian');
    }
};
