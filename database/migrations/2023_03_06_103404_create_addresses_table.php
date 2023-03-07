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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',1000)->nullable();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('phone',1000)->nullable();
            $table->string('country',1000)->nullable();
            $table->string('state',1000)->nullable();
            $table->string('city',1000)->nullable();
            $table->string('address',1000)->nullable();
            $table->string('pincode',1000)->nullable();
            $table->string('address_type',1000)->nullable();
            $table->string('default_address',1000)->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
