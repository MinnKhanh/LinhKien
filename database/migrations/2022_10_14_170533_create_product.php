<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->float('import_price');
            $table->float('price');
            $table->float('amount');
            $table->integer('status');
            $table->string('description');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('brand');

            $table->timestamps();
        });
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->string('image_name');
            $table->bigInteger('product_id')->unsigned();
            $table->integer('image_type');
            $table->timestamps();
        });
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('email');
            $table->string('vendor_address');
            $table->integer('vendor_phone');
            $table->string('vendor_website');
            $table->timestamps();
        });
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_address');
            $table->string('vendor_address');
            $table->integer('total');
            $table->integer('amount');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::create('orderDetail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('total');
            $table->integer('amount');
            $table->timestamps();
        });
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->timestamps();
        });
        Schema::create('discount', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_type');
            $table->integer('discount_percent');
            $table->integer('discount_value');
            $table->timestamps();
        });
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('brand_nation');
            $table->string('brand_description');
            $table->string('brand_website');
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
        Schema::dropIfExists('product');
    }
};
