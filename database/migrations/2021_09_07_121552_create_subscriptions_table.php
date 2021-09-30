<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('duration',8,2);
            $table->enum('durationtype', ['Years','Months']);
            $table->double('price',8,2);
            $table->enum('subscriptiontype',['Ads','Category','Both']);
            $table->integer('total_cat')->nullable();
            $table->integer('total_ad')->nullable();
            $table->integer('order_commission')->nullable();
            $table->integer('total_orders')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
