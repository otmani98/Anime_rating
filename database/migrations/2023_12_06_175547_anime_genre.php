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
        Schema::create('anime_genre', function (Blueprint $table) {
            $table->foreignId('anime_id')->index();
            $table->foreign('anime_id')->on('animes')->references('id')->cascadeOnDelete();
            $table->foreignId('genre_id')->index();
            $table->foreign('genre_id')->on('genres')->references('id')->cascadeOnDelete();
            $table->primary(['anime_id', 'genre_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
