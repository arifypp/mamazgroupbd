<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmoneys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status')->default('0');
            $table->string('amount');
            $table->unsignedBigInteger('auth_id');
            $table->string('bookingmoneymehtod')->nullable();
            $table->string('banktransaction')->nullable();
            $table->string('bankreferenceno')->nullable();
            $table->string('bkashtransiction')->nullable();
            $table->string('bkashnumber')->nullable();
            $table->string('nagadtransiction')->nullable();
            $table->string('nagadnumber')->nullable();
            $table->string('rockettransiction')->nullable();
            $table->string('rocketnumber')->nullable();
            $table->timestamps();
            
            $table->foreign('auth_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addmoneys');
    }
}
