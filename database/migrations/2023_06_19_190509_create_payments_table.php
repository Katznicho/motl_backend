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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->text('amount')->nullable();
            $table->text('payment_method')->nullable();
            $table->text('payment_status')->nullable();
            $table->text('payment_date')->nullable();
            $table->text('payment_reference')->nullable();
            $table->text('payment_description')->nullable();
            $table->text('payment_type')->nullable();
            $table->text('payment_channel')->nullable();
            $table->text('payment_channel_reference')->nullable();
            $table->text('payment_channel_status')->nullable();
            $table->text('payment_channel_response_code')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
