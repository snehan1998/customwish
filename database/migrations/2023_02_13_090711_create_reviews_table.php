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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',1000)->nullable();
            $table->string('session_id',1000)->nullable();
            $table->string('product_id',1000)->nullable();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('rating',1000)->nullable();
            $table->text('comment')->nullable();
            $table->string('review_image',1000)->nullable();
            $table->enum('status',['Active','Inactive'])->nullable();
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
        Schema::dropIfExists('reviews');
    }
};
