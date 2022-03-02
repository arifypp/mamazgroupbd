<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactpageInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactpage_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fb')->nullable();
            $table->string('fblink')->nullable();
            $table->string('tw')->nullable();
            $table->string('twlink')->nullable();
            $table->string('in')->nullable();
            $table->string('inlink')->nullable();
            $table->string('sk')->nullable();
            $table->string('sklink')->nullable();
            $table->string('lib')->nullable();
            $table->string('lilink')->nullable();
            $table->string('googlemap')->nullable();
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
        Schema::dropIfExists('contactpage_infos');
    }
}
