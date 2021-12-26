<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->double('lat');
            $table->double('lng');
            $table->string('address');
            $table->unsignedBigInteger('city_id');
            $table->integer('landline')->nullable();
            $table->integer('mobile1')->nullable();
            $table->integer('mobile2')->nullable();
            $table->integer('number_of_tables')->nullable();
            $table->integer('number_of_seats')->nullable();
            $table->integer('number_of_available_seats')->nullable();
            $table->boolean('party_area')->default(0);
            $table->boolean('kids_area')->default(0);
            $table->boolean('smooking_area')->default(0);
            $table->boolean('open_area')->default(0);
            $table->boolean('family_area')->default(0);
            $table->boolean('football_matches')->default(0);
            $table->boolean('couples_only')->default(0);
            $table->boolean('entry_fee')->default(0);
            $table->boolean('pre_paid')->default(0);
            $table->integer('commition')->nullable();
            $table->decimal('birthday_price')->nullable();
            $table->integer('birthday_commition')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
