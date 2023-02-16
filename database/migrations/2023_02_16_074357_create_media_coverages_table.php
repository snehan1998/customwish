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
        Schema::create('media_coverages', function (Blueprint $table) {
            $table->id();
            $table->string('media_name',1000)->nullable();
            $table->string('media_slug',1000)->nullable();
            $table->text('media_short_desc')->nullable();
            $table->text('media_long_desc')->nullable();
            $table->string('media_datee',1000)->nullable();
            $table->string('media_images',1000)->nullable();
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
        Schema::dropIfExists('media_coverages');
    }
};
