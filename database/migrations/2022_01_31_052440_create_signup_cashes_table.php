<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignupCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signup_cashes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('refereluser')->nullable();
            $table->string('bookingmoneymehtod')->nullable();
            $table->string('bkashtransiction')->nullable();
            $table->string('bkashnumber')->nullable();
            $table->string('nagadtransiction')->nullable();
            $table->string('nagadnumber')->nullable();
            $table->string('rockettransiction')->nullable();
            $table->string('rocketnumber')->nullable();
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
        Schema::dropIfExists('signup_cashes');
    }
}
