<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Introduce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('introduces', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('index')->nullable();
            $table->integer('relate_id')->nullable();
            $table->integer('type');
            $table->string('subtitle')->nullable();
            $table->string('link')->nullable();
            $table->integer('active');
        });
        Schema::create('rate', function (Blueprint $table) {
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_customer')->unsigned();
            $table->float('number_stars');
            $table->string('review')->nullable();
            $table->string('email')->nullable();
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
        //
    }
}
