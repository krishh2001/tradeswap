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
       Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->decimal('actual_price', 10, 2);
    $table->decimal('price', 10, 2);
    $table->integer('stock')->default(0);
    $table->text('description')->nullable();
    $table->string('product_img')->nullable(); // New field
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
