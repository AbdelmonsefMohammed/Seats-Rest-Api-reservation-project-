<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->integer('main_number')->nullable();
            $table->string('website_link')->nullable();
            $table->string('picture');
            $table->string('logo')->default('logo.png');
            $table->set('price_range', [1,2,3])->nullable();
            $table->set('type', ['Restaurant','Cafe','Bar','Party','Office']);
            $table->integer('expiration_time')->default(60);
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
        Schema::dropIfExists('restaurants');
    }
}
