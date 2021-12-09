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
            $table->foreignId('user_id')->nullable()->index();
            $table->integer('curation')->nullable();
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->integer('box_weight')->nullable();
            $table->integer('price')->nullable();
            $table->integer('ship_from')->nullable();
            $table->integer('box_height')->nullable();
            $table->integer('box_length')->nullable();
            $table->integer('box_width')->nullable();
            $table->integer('box_supply')->nullable();
            $table->integer('in_stock')->nullable();
            $table->integer('num_products')->nullable();
            $table->string('promo_code')->nullable();
            $table->integer('promo_supply')->nullable();
            $table->integer('promo_in_stock')->nullable();
            $table->string('video')->nullable();
            $table->string('product_id')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('admin_area_1')->nullable();
            $table->string('admin_area_2')->nullable();
            $table->string('country_code')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('plan_ids')->nullable();
            $table->string('page_name')->nullable();
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
        Schema::dropIfExists('boxes');
    }
}
