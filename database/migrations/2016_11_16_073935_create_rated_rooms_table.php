<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatedRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    Schema::create('rated_animals', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('animal_id')->unsigned();
           $table->integer('rate_id')->nullable()->unsigned();
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
        Schema::dropForeign(['animal_id']);
         Schema::dropForeign(['rate_id']);
        Schema::drop('rated_animals');
    }
}
