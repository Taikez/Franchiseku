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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('newsCategoryId')->nullable();
            $table->string('newsTitle')->nullable();
            $table->string('newsVideo')->nullable();
            $table->string('newsImage')->nullable();
            $table->string('newsAuthor')->nullable();
            $table->text('newsContent')->nullable();
            $table->string('newsTags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
