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
            $table->integer('pre_order')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('price')->nullable();
            $table->string('box_url')->nullable();
            $table->integer('shipping_cost')->default(0);
            $table->integer('curation')->nullable();
            $table->integer('num_products')->nullable();
            $table->integer('box_weight')->nullable();
            $table->integer('box_length')->nullable();
            $table->integer('box_width')->nullable();
            $table->integer('box_height')->nullable();
            $table->string('prodname')->nullable();
            $table->string('proddesc')->nullable();
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
