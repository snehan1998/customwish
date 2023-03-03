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
        Schema::create('corporate_gifts', function (Blueprint $table) {
            $table->id();
            $table->string('category_id',1000)->nullable();
            $table->string('subcategory_id',1000)->nullable();
            $table->string('childcategory_id',1000)->nullable();
            $table->string('corp_product_name',1000)->nullable();
            $table->string('corp_product_slug',1000)->nullable();
            $table->text('corp_product_desc')->nullable();
            $table->string('status',1000)->nullable();
            $table->string('meta_title',1000)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('corporate_gifts');
    }
};
