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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->string('attr_id',1000)->nullable();
            $table->string('attr_value_title',1000)->nullable();
            $table->string('attr_value_name',1000)->nullable();
            $table->string('attr_value_slug',1000)->nullable();
            $table->string('attr_color',1000)->nullable();
            $table->string('is_default',1000)->nullable();
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
        Schema::dropIfExists('attribute_values');
    }
};
