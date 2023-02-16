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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',1000)->nullable();
            $table->string('user_id',1000)->nullable();
            $table->string('order_price',1000)->nullable();
            $table->string('payable_price',1000)->nullable();
            $table->string('order_date',1000)->nullable();
            $table->string('coupon_id',1000)->nullbale();
            $table->string('coupon_amount',1000)->nullbale();
            $table->string('delivery_charge')->nullbale();
            $table->enum('status', ['processing','received', 'packed', 'shipped', 'delivered'])->default('processing');
            $table->enum('payment_type', ['cod', 'online']);
            $table->string('firstname',255)->nullable();
            $table->string('lastname',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('city',255)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('pincode',255)->nullable();
            $table->enum('address_type', ['home','office','other'])->nullable();
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
        Schema::dropIfExists('orders');
    }
};
