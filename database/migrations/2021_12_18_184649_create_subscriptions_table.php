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
            $table->foreignId('uid');
            $table->string('fullname');
            $table->integer('cfp');
            $table->string('sub_id');
            $table->integer('version');
            $table->integer('price');
            $table->integer('frequency');
            $table->integer('status');
            $table->string('tracking');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('admin_area_1');
            $table->string('admin_area_2');
            $table->string('postal_code');
            $table->string('country_code');
            $table->string('rate_id');
            $table->string('rate');
            $table->string('shipment');
            $table->string('plan_id');
            $table->string('last_shipping');
            $table->string('label');
            $table->string('carrier');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
