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
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('billing_id')->unsigned()->index();
            $table->string('order_id');
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('cascade');
            $table->string('productname');
            $table->string('price');
            $table->string('qty');
            $table->string('image');
            $table->string('tranaction_id');
            $table->string('last4');
            $table->string('cardtype');
            $table->string('paymentstatus');
            $table->softDeletes();
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
