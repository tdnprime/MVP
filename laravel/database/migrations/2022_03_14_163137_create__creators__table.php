<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_creators_', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name')->nullable();
            $table->string('channel_id')->unique();
            $table->integer('views')->nullable();
            $table->integer('videos')->nullable();
            $table->string('email')->nullable();
            $table->string('category')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('_creators_');
    }
}
