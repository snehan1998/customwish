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
        Schema::create('store_cart_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('att_id',1000)->nullable();
            $table->string('attribute',1000)->nullable();
            $table->string('buttonid',1000)->nullable();
            $table->string('variationaddtext1',1000)->nullable();
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
        Schema::dropIfExists('store_cart_attributes');
    }
};
