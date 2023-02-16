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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code',1000)->nullable();
            $table->enum('discount_type', ['Flat','Percentage'])->nullable();
            $table->string('discount_amount',1000)->nullable();
            $table->string('minimum_order',1000)->nullable();
            $table->string('validity_till',1000)->nullable();
            $table->string('validity_from',1000)->nullable();
            $table->enum('status', ['Active','Inactive'])->nullable();
            $table->enum('allow_multiple_use', ['Yes','NO'])->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
