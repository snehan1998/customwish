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
        Schema::create('gift_card_buys', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',1000)->nullable();
            $table->string('user_id',1000)->nullable();
            $table->string('order_date',1000)->nullable();
            $table->string('generated_code',1000)->nullable();
            $table->string('giftcard_id',1000)->nullable();
            $table->string('giftcard_name',1000)->nullable();
            $table->string('giftcard_price',1000)->nullable();
            $table->string('to_email',1000)->nullable();
            $table->string('from_name',1000)->nullable();
            $table->text('message')->nullable();
            $table->string('delivery_date',1000)->nullable();
            $table->string('firstname',1000)->nullable();
            $table->string('lastname',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('country',1000)->nullable();
            $table->string('state',1000)->nullable();
            $table->string('city',1000)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('pincode',1000)->nullable();
            $table->string('address_type',10)->nullable();
            $table->enum('mail_sent',['notsent','sent'])->default('notsent');
            $table->enum('coupon',['notused','used'])->default('notused');
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
        Schema::dropIfExists('gift_card_buys');
    }
};
