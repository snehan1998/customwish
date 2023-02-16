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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('address',1000)->nullable();
            $table->text('opening_hour')->nullable();
            $table->text('content')->nullable();
            $table->string('facebook',1000)->nullable();
            $table->string('twitter',1000)->nullable();
            $table->string('linkedin',1000)->nullable();
            $table->string('instagram',1000)->nullable();
            $table->string('map',1000)->nullable();
            $table->string('contact_banner_image',1000)->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
