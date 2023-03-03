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
        Schema::create('corporate_gift_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('corporate_id')->unsigned();
            $table->string('images',1000)->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporate_gifts')->onDelete('cascade');
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
        Schema::dropIfExists('corporate_gift_images');
    }
};
