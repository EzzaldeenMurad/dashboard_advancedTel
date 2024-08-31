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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name');
            $table->string('offer_type');
            $table->string('company_name');
            $table->double('price');
            $table->string('offer_code');
            $table->string('subscription_type')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('validity')->nullable();
            $table->string('minutes')->nullable();
            $table->string('sms')->nullable();
            $table->string('internet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
