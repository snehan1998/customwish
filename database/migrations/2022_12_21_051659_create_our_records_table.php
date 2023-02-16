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
        Schema::create('our_records', function (Blueprint $table) {
            $table->id();
            $table->string('title',1000)->nullable();
            $table->string('yearr',1000)->nullable();
            $table->text('desc')->nullable();
            $table->string('our_image',1000)->nullable();
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
        Schema::dropIfExists('our_records');
    }
};
