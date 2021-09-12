<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->string('description');
            $table->double('price',8,2);
            $table->double('discountprice',8,2)->nullable();
            $table->date('discountvalidfrom')->nullable();
            $table->date('discountvalidto')->nullable();
            $table->string('image');
            $table->integer('tax_id')->nullable();
            $table->integer('shop_id');
            $table->enum('trending', ['latest','featured'])->default('featured');
            $table->enum('pricetype', ['fixed','percent'])->default('fixed');
             $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
}
