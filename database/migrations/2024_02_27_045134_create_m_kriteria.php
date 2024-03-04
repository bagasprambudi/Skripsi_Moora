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
        Schema::create('m_kriteria', function (Blueprint $table) {
            $table->id('kriteria_id');
            $table->integer('periode_id')->index();
            $table->string('keterangan', 100);
            $table->string('kriteria_kode', 100);
            $table->double('bobot');
            $table->string('jenis', 100);

            $table->foreign('periode_id')->references('periode_id')->on('m_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kriteria');
    }
};
