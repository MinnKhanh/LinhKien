<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationshop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_shop', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->string('address');
            $table->string('coordinates')->nullable();
            $table->string('nation');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('accountbank');
            $table->string('namebank');
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
        Schema::dropIfExists('informationshop');
    }
}
