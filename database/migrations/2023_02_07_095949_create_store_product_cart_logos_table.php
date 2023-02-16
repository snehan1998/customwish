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
        Schema::create('store_product_cart_logos', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',1000)->nullable();
            $table->string('user_id',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('product_cart_id',1000)->nullable();
            $table->string('cart_logo',1000)->nullable();
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
        Schema::dropIfExists('store_product_cart_logos');
    }
};
