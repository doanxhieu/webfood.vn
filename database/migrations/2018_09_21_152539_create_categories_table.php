<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() { 
        Schema::create('categories', function (Blueprint $table) { 
            $table->increments('id'); 
            $table->string('slug', 80)->unique(); 
            $table->unsignedInteger('parent_id')->default(0); 
            $table->timestamps(); 

        }); 
        Schema::create('category_translations', function (Blueprint $table) { 
            $table->increments('id'); 
            $table->unsignedInteger('category_id'); 
            $table->char('lang', 2); 
            $table->string('name', 80); 
            $table->timestamps(); 
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
    }
}
