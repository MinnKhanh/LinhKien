<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user')->unsigned();
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('name')->nullable();
            $table->string('note');
            $table->string('phone');
            $table->string('email');
            $table->float('discount', 20, 2)->nullable();
            $table->float('ship', 20, 2)->nullable();
            $table->integer('type')->default(1);
            $table->float('totalPrice', 20, 2);
            $table->integer('quantity');
            $table->integer('paymentmethod')->default(1);
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
