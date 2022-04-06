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
            $table->integer('version');
            $table->integer('price');
            $table->integer('frequency');
            $table->integer('status');
            $table->string('tracking')->nullable();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('admin_area_1');
            $table->string('admin_area_2');
            $table->string('postal_code');
            $table->string('country_code');
            $table->string('billing_given_name')->nullable();
            $table->string('billing_family_name')->nullable();
            $table->string('billing_country_code')->nullable();
            $table->string('billing_address_line_1')->nullable();
            $table->string('billing_address_line_2')->nullable();
            $table->string('billing_admin_area_1')->nullable();
            $table->string('billing_admin_area_2')->nullable();
            $table->string('billing_postal_code')->nullable();
            $table->string('rate_id')->nullable();
            $table->string('rate')->nullable();
            $table->string('shipment')->nullable();
            $table->string('plan_id');
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
