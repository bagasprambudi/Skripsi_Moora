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
        Schema::create('m_sub_kriteria', function (Blueprint $table) {
            $table->id('sub_kriteria_id');
            $table->unsignedBigInteger('kriteria_id')->index();
            $table->integer('periode_id')->index();
            $table->string('deskripsi' , 200);
            $table->double('nilai');

            $table->foreign('kriteria_id')->references('kriteria_id')->on('m_kriteria');
            $table->foreign('periode_id')->references('periode_id')->on('m_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_sub_kriteria');
    }
};
