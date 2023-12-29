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
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->string('franchiseName');
            $table->string('franchiseLocation')->nullable();
            $table->string('franchiseCategory');
            $table->integer('franchisePrice');
            $table->string('franchiseLogo');
            $table->string('franchisePIC');
            $table->string('franchisePICName');
            $table->string('franchiseReport')->nullable();
            $table->string('status');
            $table->decimal('franchiseRating', 3, 2)->nullable();
            $table->text('franchiseDesc')->nullable();
            $table->timestamps();

            // Define the foreign key constraint with a different name for the column
            $table->unsignedBigInteger('franchise_category_id'); // You can choose any name you prefer
        
            // Define the foreign key relationship
            $table->foreign('franchise_category_id')->references('id')->on('franchise_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchises');
    }
};
