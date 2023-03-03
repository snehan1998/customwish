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
        Schema::create('corporate_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('corporate_id',1000)->nullable();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('phone',1000)->nullable();
            $table->string('quantity',1000)->nullable();
            $table->string('message',1000)->nullable();
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
        Schema::dropIfExists('corporate_enquiries');
    }
};
