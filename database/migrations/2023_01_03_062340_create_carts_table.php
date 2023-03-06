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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',1000)->nullable();
            $table->string('user_id',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('variation_id',1000)->nullable();
            $table->string('product_cart_id',1000)->nullable();
            $table->string('quantity',1000)->nullable();
            $table->string('price',1000)->nullable();
            $table->string('coupon_id',1000)->nullable();
            $table->string('giftcard_id',1000)->nullable();
            $table->string('product_button_id',1000)->nullable();
            $table->string('product_images_id',1000)->nullable();
            $table->string('product_logos_id',1000)->nullable();
            $table->string('variation_text_field',1000)->nullable();
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
        Schema::dropIfExists('carts');
    }
};
