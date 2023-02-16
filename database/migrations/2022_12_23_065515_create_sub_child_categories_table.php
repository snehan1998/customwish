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
        Schema::create('sub_child_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('childcategory_id')->unsigned();
            $table->string('subchildcat_name',1000)->nullable();
            $table->string('subchildcat_slug',1000)->nullable();
            $table->enum('subchildstatus',['Active','Inactive']);
            $table->text('subchilddescription')->nullable();
            $table->string('subchildcat_image',1000)->nullable();
            $table->string('subchildcat_logo',1000)->nullable();
            $table->string('top_subchildcategory',1000)->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');
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
        Schema::dropIfExists('sub_child_categories');
    }
};
