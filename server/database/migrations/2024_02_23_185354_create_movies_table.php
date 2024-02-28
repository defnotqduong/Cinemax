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
            $table->string('name_eng')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('status')->default(true); // published or unpublished
            $table->string('season')->default('0');
            $table->integer('eps')->nullable(); // Số tập phim
            $table->integer('episode_current')->nullable(); // Tập phim hiện tại
            $table->string('year')->nullable(); // năm sản xuất
            $table->integer('view')->nullable();
            $table->string('duration')->nullable(); // thời lượng phim
            $table->integer('resolution')->default(0); // 0 - FullHD, 1 - HD, 2 - SD, 3 - HDCam, 4 - Cam , 5 - Trailer
            $table->boolean('subtitle')->default(true); // true - vietsub, false - thuyet minh
            $table->longText('tags')->nullable(); // từ khóa
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
