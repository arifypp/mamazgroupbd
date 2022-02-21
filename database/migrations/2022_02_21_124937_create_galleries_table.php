<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleriescat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->unsignedInteger('gallaryscatid');
            $table->foreign('gallaryscatid')->references('id')->on('galleriescat')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('galleriestitle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('desc');
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
        Schema::dropIfExists('galleriescat');
        Schema::dropIfExists('galleriestitle');
        Schema::dropIfExists('galleries');
    }
}
