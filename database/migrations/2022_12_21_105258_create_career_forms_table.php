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
        Schema::create('career_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('phone',1000)->nullable();
            $table->string('position',1000)->nullable();
            $table->string('experience',1000)->nullable();
            $table->string('resume',1000)->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('career_forms');
    }
};
