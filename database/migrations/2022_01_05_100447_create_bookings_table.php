<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('nid')->nullable();
            $table->string('dob')->nullable();
            $table->string('marridstatus')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('fathername')->nullable();
            $table->string('mothername')->nullable();
            $table->string('spuseorhubby')->nullable();
            $table->string('children')->nullable();
            $table->string('presentaddress')->nullable();
            $table->string('permanentaddress')->nullable();
            $table->string('profession')->nullable();
            $table->string('officeaddress')->nullable();

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
        Schema::dropIfExists('bookings');
    }
}
