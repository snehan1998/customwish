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
        Schema::create('product_combooos', function (Blueprint $table) {
            $table->id();
            $table->string('combo_id',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('button_name',1000)->nullable();
            $table->string('combo_attr_id',1000)->nullable();
            $table->string('combo_attr_value',1000)->nullable();
            $table->string('combo_text_field',1000)->nullable();
            $table->string('combo_text_heading',1000)->nullable();
            $table->string('combo_text_validation',1000)->nullable();
            $table->string('is_charm',1000)->nullable();
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
        Schema::dropIfExists('product_combooos');
    }
};
