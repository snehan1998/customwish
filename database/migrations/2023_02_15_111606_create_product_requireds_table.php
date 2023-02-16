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
        Schema::create('product_requireds', function (Blueprint $table) {
            $table->id();
            $table->string('product_id',1000)->nullable();
            $table->string('location_required',1000)->nullable();
            $table->string('datee_required',1000)->nullable();
            $table->string('timee_required',1000)->nullable();
            $table->string('textarea_required',1000)->nullable();
            $table->string('eggoreggless_required',1000)->nullable();
            $table->string('imageupload_required',1000)->nullable();
            $table->string('textfield_required',1000)->nullable();
            $table->string('logoupload_required',1000)->nullable();
            $table->string('addtext_required',1000)->nullable();
            $table->string('flowertype_required',1000)->nullable();
            $table->string('selfpickup_required',1000)->nullable();
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
        Schema::dropIfExists('product_requireds');
    }
};
