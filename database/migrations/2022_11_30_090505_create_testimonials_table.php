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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name',1000)->nullable();
            $table->string('designation',1000)->nullable();
            $table->text('description')->nullable();
            $table->string('letter',1000)->nullable();
            $table->string('image1',1000)->nullable();
            $table->string('image2',1000)->nullable();
            $table->string('rating',1000)->nullable();
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
        Schema::dropIfExists('testimonials');
    }
};
