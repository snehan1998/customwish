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
        Schema::create('leave_comments', function (Blueprint $table) {
            $table->id();
            $table->string('blog_id',1000)->nullable();
            $table->string('blog_name',1000)->nullable();
            $table->string('name',1000)->nullable();
            $table->string('email',1000)->nullable();
            $table->string('website',1000)->nullable();
            $table->text('comment')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Inactive');
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
        Schema::dropIfExists('leave_comments');
    }
};
