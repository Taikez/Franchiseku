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
            $table->string('franchise_category_id')->nullable();
            $table->integer('franchisePrice');
            $table->string('franchiseLogo');
            $table->string('franchisePIC');
            $table->string('franchisePICName');
            $table->string('franchiseReport')->nullable();
            $table->string('status');
            $table->timestamps();
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
