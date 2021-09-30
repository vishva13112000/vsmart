<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->enum('payment_type',['Offline','Online','Bank']);
            $table->string('payment_id')->nullable();
            
            $table->string('narration');
            $table->date('date');
            $table->double('credit',18,2)->default(0.0);
            $table->double('debit',18,2)->default(0.0);
            $table->double('total',18,2)->default(0.0);

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
        Schema::dropIfExists('balance_sheets');
    }
}
