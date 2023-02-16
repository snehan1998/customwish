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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('subcat_name',1000)->nullable();
            $table->string('subcat_slug',1000)->nullable();
            $table->enum('status',['Active','Inactive']);
            $table->text('description')->nullable();
            $table->string('top_subcategory',1000)->nullable();
            $table->string('subcat_image',1000)->nullable();
            $table->string('subcat_logo',1000)->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('sub_categories');
    }
};
