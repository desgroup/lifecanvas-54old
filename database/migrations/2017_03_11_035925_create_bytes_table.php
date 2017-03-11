<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBytesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bytes', function (Blueprint $table) {
            $table->increments('id');
            // mandatory title for the byte
            $table->string('name');
            // optional free text to elaborate on the byte
            $table->text('story')->nullable();
            // 5 star rating
            $table->tinyInteger('rating')->nullable();
            // not sure what this was supposed to be -> TODO-KGW clean up type field
            //$table->tinyInteger('type')->default('0');
            // privacy setting for the byte: 0 is private, 1 is friends, 2 is world
            $table->tinyInteger('privacy')->default('0');
            // not sure what this is either -> TODO-KGW clean up time_perspective field
            //$table->tinyInteger('time_perspective')->nullable();
            // the date the byte happened in UTC, can be empty
            $table->dateTime('byte_date')->nullable();
            // a code that indicates what part of the date you are sure of
            $table->string('accuracy')->nullable();
            // the timezone id for the byte_date that provides the UTC offset
            $table->integer('timezone_id')->nullable()->unsigned();
            // The latitude where the byte was captured from the device, can be Null
            $table->double('lat')->nullable();
            // The longitude where the byte was captured from the device, can be Null
            $table->double('lng')->nullable();
            // the id for the record in the image table
            $table->integer('image_id')->nullable()->unsigned();
            // the id for the record for the place associated with the byte
            $table->integer('place_id')->nullable()->unsigned();
            // the user id for the user that created the byte
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('bytes');
    }
}
