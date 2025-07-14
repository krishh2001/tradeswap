<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_bills_table.php
public function up()
{
    Schema::create('bills', function (Blueprint $table) {
        $table->id();
        $table->string('bill_no')->unique();
        $table->unsignedBigInteger('user_id');
        $table->decimal('amount', 10, 2);
        $table->decimal('cashback', 10, 2)->nullable();
        $table->enum('status', ['pending', 'approved', 'discarded'])->default('pending');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
