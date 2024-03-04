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
        Schema::create('t_hasil', function (Blueprint $table) {
            $table->id('hasil_id');
            $table->unsignedBigInteger('alternatif_id')->index();
            $table->integer('periode_id')->index();
            $table->double( 'nilai');

            $table->foreign('alternatif_id')->references('alternatif_id')->on('m_alternatif');
            $table->foreign('periode_id')->references('periode_id')->on('m_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_hasil');
    }
};
