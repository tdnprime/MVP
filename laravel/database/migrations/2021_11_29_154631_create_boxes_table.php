<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->bigIncrements('vid');
            $table->unsignedBigInteger('user_id')->unique();
            $table->integer('pre_order')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('price')->nullable();
            $table->string('box_url')->unique();
            $table->integer('shipping_cost')->default(0);
            $table->integer('ship_from')->default(1);
            $table->integer('curation')->nullable();
            $table->integer('num_products')->nullable();
            $table->integer('box_supply')->nullable();
            $table->string('in_stock')->nullable();
            $table->integer('box_weight')->nullable();
            $table->integer('box_length')->nullable();
            $table->integer('box_width')->nullable();
            $table->integer('box_height')->nullable();
            $table->string('prodname')->nullable();
            $table->string('proddesc')->nullable();
            $table->string('product_id')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('admin_area_1')->nullable();
            $table->string('admin_area_2')->nullable();
            $table->string('country_code')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('video')->nullable();
            $table->integer('shipping_count')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxes');
    }
}
