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
        Schema::create('education_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('paymentType')->nullable();
            $table->string('transaction_id');
            $table->string('transaction_status');
            $table->string('order_id');
            $table->string('paymentCode');
            $table->string('jsonData');
            $table->string('pdf_url');
            $table->string('fraud_status');
            $table->string('snap_token', 36)->nullable();
            $table->decimal('total_price', 10, 2);

            //data user
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            //bikin2 aja
            $table->string('username');
            $table->string('email');
            $table->string('phoneNumber'); 
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_transaction');
    }
};
