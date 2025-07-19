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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
           $table->decimal('actual_price', 10, 2);
            $table->decimal('price', 10, 2);
            $table->integer('validity_days')->default(30); // Subscription duration
            $table->integer('reward_limit')->default(50);   // Max rewards claimable
            $table->text('description')->nullable();         // Optional plan description
            $table->json('features')->nullable();            // JSON list of plan features
            $table->boolean('status')->default(true);        // Active/inactive toggle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
