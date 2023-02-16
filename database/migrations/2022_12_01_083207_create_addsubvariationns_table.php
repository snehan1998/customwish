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
        Schema::create('addsubvariationns', function (Blueprint $table) {
            $table->id();
            $table->string('main_attr_id',1000)->nullable();
            $table->string('main_attr_value',1000)->nullable();
            $table->string('product_button_id',1000)->nullable();
            $table->string('price',1000)->nullable();
            $table->string('strike_price',1000)->nullable();
            $table->string('discount',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('stock',1000)->nullable();
            $table->string('def',1000)->nullable();
            $table->string('quantity',1000)->nullable();
            $table->string('skucode',1000)->nullable();
            $table->string('subvar_id',1000)->nullable();
            $table->string('var_id',1000)->nullable();
            $table->string('product_price_id',1000)->nullable();
            $table->string('variation_text_field',10)->nullable();
            $table->string('variation_text_heading',100)->nullable();
            $table->string('variation_text_validation',100)->nullable();
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
        Schema::dropIfExists('addsubvariationns');
    }
};
