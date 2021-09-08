<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ownername');
            $table->string('email');
            $table->string('contact');
            $table->text('address');
            $table->boolean('active')->default(1);
            $table->timestamps();
             $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopss');
    }
}
