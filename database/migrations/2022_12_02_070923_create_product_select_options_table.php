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
        Schema::create('product_select_options', function (Blueprint $table) {
            $table->id();
            $table->string('product_id',1000)->nullable();
            $table->string('combo_id',1000)->nullable();
            $table->string('product_select_id',1000)->nullable();
            $table->string('product_select_option',1000)->nullable();
            $table->string('product_select_option_price',1000)->nullable();
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
        Schema::dropIfExists('product_select_options');
    }
};
