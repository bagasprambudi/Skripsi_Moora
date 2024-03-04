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
        Schema::create('d_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('user_level_id')->index();
            $table->string('nama', 200);
            $table->string('email', 100);
            $table->string('username', 100);
            $table->string('password', 100);

            $table->foreign('user_level_id')->references('user_level_id')->on('d_user_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_user');
    }
};
