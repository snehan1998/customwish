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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('phone',1000)->nullable();
            $table->string('country',1000)->nullable();
            $table->string('state',1000)->nullable();
            $table->string('city',1000)->nullable();
            $table->text('address',1000)->nullable();
            $table->string('pincode',1000)->nullable();
            $table->string('password',1000)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_profiles');
    }
};
