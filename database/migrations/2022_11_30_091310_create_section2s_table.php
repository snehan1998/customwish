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
        Schema::create('section2s', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000)->nullable();
            $table->string('image',1000)->nullable();
            $table->string('button_name',1000)->nullable();
            $table->string('button_url',1000)->nullable();
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
        Schema::dropIfExists('section2s');
    }
};
