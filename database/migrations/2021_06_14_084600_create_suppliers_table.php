<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('name');
            $table->string('service'); 
            $table->boolean('party_area');
            $table->boolean('kids_area');
            $table->boolean('smooking_area');
            $table->boolean('open_area');
            $table->boolean('family_area');
            $table->boolean('football_matches');
            $table->boolean('couples_only');
            $table->boolean('entry_fee');
            $table->boolean('pre_paid');
            $table->integer('commition')->nullable();
            $table->decimal('birthday_price')->nullable();
            $table->integer('birthday_commition')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
