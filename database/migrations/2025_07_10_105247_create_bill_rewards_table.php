<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillRewardsTable extends Migration
{
    public function up()
    {
        Schema::create('bill_rewards', function (Blueprint $table) {
            $table->id();
            $table->string('plan')->nullable();
            $table->string('bill_no')->unique();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);
            $table->decimal('reward', 10, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'discarded'])->default('pending');
            $table->string('bill_pdf')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bill_rewards');
    }
}
