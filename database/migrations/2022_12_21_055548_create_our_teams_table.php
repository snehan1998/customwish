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
        Schema::create('our_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name',1000)->nullable();
            $table->string('designation',1000)->nullable();
            $table->text('description')->nullable();
            $table->string('facebook',1000)->nullable();
            $table->string('instagram',1000)->nullable();
            $table->string('twitter',1000)->nullable();
            $table->string('team_image',1000)->nullable();
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
        Schema::dropIfExists('our_teams');
    }
};
