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
        Schema::create('detail_education_transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactionId');
            $table->foreign('transactionId')->references('id')->on('users');
            $table->unsignedBigInteger('educationContentId');
            $table->foreign('educationContentId')->references('id')->on('education_contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_education_transaction');
    }
};
