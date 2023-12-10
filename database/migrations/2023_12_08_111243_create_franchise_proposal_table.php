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
        Schema::create('franchise_proposal', function (Blueprint $table) {
            $table->id();
            $table->string('proposerName')->nullable();
            $table->string('proposerEmail')->nullable();
            $table->string('proposerPhoneNumber')->nullable();
            $table->string('proposalFile')->nullable();
            $table->longText('proposalDescription')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('franchise_id');
            $table->foreign('franchise_id')->references('id')->on('franchises');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchise_proposal');
    }
};
