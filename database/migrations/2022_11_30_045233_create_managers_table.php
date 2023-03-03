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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',1000)->nullable();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('phone',1000)->nullable();
            $table->string('dob',1000)->nullable();
            $table->enum('gender',['Male','Female'])->nullable();
            $table->string('id_proof',1000)->nullable();
            $table->string('password',1000)->nullable();
            $table->string('old_password',1000)->nullable();
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
        Schema::dropIfExists('managers');
    }
};
