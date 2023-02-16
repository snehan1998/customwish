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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('childcategory_id')->unsigned();
            $table->bigInteger('subchildcategory_id')->unsigned();
            $table->string('product_name',1000)->nullable();
            $table->string('slug',1000)->nullable();
            $table->text('pro_short_desc')->nullable();
            $table->text('pro_long_desc')->nullable();
            $table->text('specification')->nullable();
            $table->text('delivery_info')->nullable();
            $table->text('color_desclaimer')->nullable();
            $table->text('return_policy')->nullable();
            $table->text('review')->nullable();
            $table->enum('status',['Active','Inactive'])->nullable();
            $table->string('price',1000)->nullable();
            $table->string('strick_price',1000)->nullable();
            $table->string('discount',100)->nullable();
            $table->enum('stock_status',['instock','outofstock'])->nullable();
            $table->string('quantity',1000)->nullable();
            $table->string('skucode',255)->nullable();
            $table->string('is_variation',10)->nullable();
            $table->string('trending',10)->nullable();
            $table->string('youmayalsolike',10)->nullable();
            $table->string('newarrivalgift',10)->nullable();
            $table->string('is_combo',10)->nullable();
            $table->string('pro_attributes',1000)->nullable();
            $table->string('pro_combo_attributes',1000)->nullable();
            $table->string('flower_type_option',10)->nullable();
            $table->string('button_type_option',10)->nullable();
            $table->string('related_products',1000)->nullable();
            $table->string('cake_id',1000)->nullable();
            $table->string('location',10)->nullable();
            $table->string('datee',10)->nullable();
            $table->string('timee',10)->nullable();
            $table->string('comment',10)->nullable();
            $table->string('comment_heading',100)->nullable();
            $table->string('query',10)->nullable();
            $table->string('self_pickup',10)->nullable();
            $table->string('textareaa',10)->nullable();
            $table->string('textarea_name',100)->nullable();
            $table->string('textarea_validation',100)->nullable();
            $table->string('eggoreggless',10)->nullable();
            $table->string('quantity_show',10)->nullable();
            $table->string('imageuploadoption',10)->nullable();
            $table->string('imageuploadoption_heading',100)->nullable();
            $table->string('imageuploadoption_validation',100)->nullable();
            $table->string('imageuploadoption_size',100)->nullable();
            $table->string('text_field',10)->nullable();
            $table->string('text_heading',100)->nullable();
            $table->string('text_validation',100)->nullable();
            $table->string('frontandbackprint_option',10)->nullable();
            $table->string('single_option',10)->nullable();
            $table->string('giftwrapper_option',10)->nullable();
            $table->string('giftwrapper_price',100)->nullable();
            $table->string('anyspecificdesign_option',10)->nullable();
            $table->string('haveadesigninmind_option',10)->nullable();
            $table->string('uploadlogo_option',10)->nullable();
            $table->string('uploadlogo_heading',100)->nullable();
            $table->string('uploadlogo_validation',100)->nullable();
            $table->string('uploadlogo_size',100)->nullable();
            $table->string('addatext_option',10)->nullable();
            $table->string('addatext_heading',100)->nullable();
            $table->string('addatext_validation',100)->nullable();
            $table->mediumText('meta_title')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->mediumText('meta_keywords')->nullable();
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
        Schema::dropIfExists('products');
    }
};
