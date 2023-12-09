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
        Schema::create('education_contents', function (Blueprint $table) {
            $table->id(); // This line creates an auto-incrementing 'id' column as the primary key
        
            $table->string('educationTitle')->nullable();
            $table->text('educationDesc')->nullable();
            $table->integer('educationPrice')->nullable();
            $table->string('educationAuthor')->nullable();
            $table->string('educationCategory')->nullable();
            $table->string('educationThumbnail')->nullable();
            $table->text('educationShortDesc')->nullable();
            $table->string('educationVideo')->nullable();
            $table->decimal('educationRating', 3, 2)->nullable();
            $table->timestamps();
        
            // Define the foreign key constraint with a different name for the column
            $table->unsignedBigInteger('education_category_id'); // You can choose any name you prefer
        
            // Define the foreign key relationship
            $table->foreign('education_category_id')->references('id')->on('education_categories');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_contents');
    }
};
