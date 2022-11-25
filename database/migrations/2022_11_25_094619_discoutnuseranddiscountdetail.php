<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Discoutnuseranddiscountdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_user', function (Blueprint $table) {
            $table->bigInteger('id_customer')->unsigned();
            $table->bigInteger('id_discount')->unsigned();
            $table->integer('use')->default(0);
        });
        Schema::create('discount_detail', function (Blueprint $table) {
            $table->bigInteger('id_discount')->unsigned();
            $table->integer('condition')->unsigned();
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
