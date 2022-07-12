<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('creator_id')->nullable();
            $table->foreignId('user_id');
            $table->string('given_name');
            $table->string('family_name');
            $table->bigInteger('cpf')->nullable();
            $table->string('sub_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('frequency')->nullable();
            $table->integer('status')->nullable();
            $table->string('tracking')->nullable();
            $table->string('rate_id')->nullable();
            $table->string('rate')->nullable();
            $table->string('shipment')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('card_id')->nullable();
            $table->string('last_shipping')->nullable();
            $table->string('label')->nullable();
            $table->string('carrier')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
