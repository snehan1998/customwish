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
        Schema::create('order_lists', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',1000)->nullable();
            $table->string('user_id',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('variation_id',1000)->nullable();
            $table->string('mrp_price',1000)->nullable();
            $table->string('selling_price',1000)->nullable();
            $table->string('quantity',1000)->nullable();
            $table->enum('status',['Processing','Packed','Shipped','Delivered','Cancelled','CancelledbyUser','Refund','Return','ReturnNotAcceptedByAdmin'])->defaultValue('Processing')->nullable();
            $table->text('return_reason')->nullable();
            $table->mediumText('egg_type')->nullable();
            $table->string('imageupload',1000)->nullable();
            $table->string('logoupload',1000)->nullable();
            $table->mediumText('addtext1')->nullable();
            $table->mediumText('addtext2')->nullable();
            $table->string('cart_combo_id',1000)->nullable();
            $table->string('cart_charm_id',1000)->nullable();
            $table->string('product_images_id',1000)->nullable();
            $table->string('product_logos_id',1000)->nullable();
            $table->string('charm_id',1000)->nullable();
            $table->string('charm_price',1000)->nullable();
            $table->mediumText('printside')->nullable();
            $table->mediumText('colortype')->nullable();
            $table->string('location',1000)->nullable();
            $table->mediumText('flowerss_type')->nullable();
            $table->string('datee',1000)->nullable();
            $table->string('timee',1000)->nullable();
            $table->mediumText('pickup_type')->nullable();
            $table->string('giftwrap',1000)->nullable();
            $table->string('giftwrap_price',1000)->nullable();
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('order_lists');
    }
};
