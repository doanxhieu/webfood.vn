<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 128)->unique();
            $table->unsignedInteger('category_id')->nullable();
            $table->char('code', 10)->nullable();
            $table->string('made_in', 50)->default('');
            $table->string('unit', 20)->default('');
            $table->string('photo', 255)->nullable();
            $table->unsignedInteger('user_id');
            $table->float('price')->default(0)->comment('chi phí sx, nhập');
            $table->float('promotion_price')->default(0)->comment('giá khuyến mãi');
            $table->unsignedInteger('quantity')->default(0);
            $table->float('rating')->default(0);
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->char('lang', 2);
            $table->string('title', 128);
            $table->string('brief', 255);
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('product');
    }
}
