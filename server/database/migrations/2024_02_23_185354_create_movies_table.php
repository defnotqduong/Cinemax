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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(true);
            $table->string('thumbnail');
            $table->integer('resolution')->default(0); // 0 - FullHD, 1 - HD, 2 - SD, 3 - HDCam, 4 - Cam
            $table->boolean('subtitle')->default(true); // true - vietsub, false - thuyet minh
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('genre_id')->constrained('genres');
            $table->foreignId('country_id')->constrained('countries');
            $table->timestamps();

            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
