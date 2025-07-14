<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bill_rewards', function (Blueprint $table) {
        $table->id();
        $table->string('bill_no')->unique();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 10, 2);
        $table->decimal('reward', 10, 2)->nullable();
        $table->string('status')->default('pending'); // pending, approved, discarded
        $table->string('bill_pdf')->nullable(); // optional PDF link
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_rewards');
    }
};
