<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            // The display name for the person: e.g. Mom, Carter, Brad Pit
            $table->string('name');
            // The relationship of the person to the user if any. Can be Null.
            $table->integer('relationship')->nullable();
            // The Lifecanvas user_id for the person if they have one. Can be Null
            $table->integer('account_id')->nullable();
            // The user_id of the owner of the person.
            $table->integer('user_id');
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
        Schema::dropIfExists('people');
    }
}
