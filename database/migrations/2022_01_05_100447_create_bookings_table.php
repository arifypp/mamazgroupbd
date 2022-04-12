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
            $table->string('bookingid')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->default('0')->comment('0 for pending, 1 for decliend, 2 for progressing, 3 for approved');
            $table->string('name')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nidnumber')->nullable();
            $table->string('dob')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('fathername')->nullable();
            $table->string('fatherphone')->nullable();
            $table->string('mothername')->nullable();
            $table->string('motherphone')->nullable();
            $table->string('spousename')->nullable();
            $table->string('spousephonenumber')->nullable();
            $table->string('flatorhouse')->nullable();
            $table->string('divisionid')->nullable();
            $table->string('districtid')->nullable();
            $table->string('thanaid')->nullable();
            $table->string('ppostoffice')->nullable();
            $table->string('ppostcode')->nullable();
            $table->string('permanenthouse')->nullable();
            $table->string('permanetdivisionid')->nullable();
            $table->string('permanentdistrictid')->nullable();
            $table->string('permanentthanaid')->nullable();
            $table->string('permanentpostoffice')->nullable();
            $table->string('permanentpostcode')->nullable();
            $table->string('nominyname')->nullable();
            $table->string('nominyphone')->nullable();
            $table->string('nominyaddress')->nullable();
            $table->string('nominynid')->nullable();
            $table->string('nominyrelatoin')->nullable();
            $table->string('referelname')->nullable();
            $table->string('referelphone')->nullable();
            $table->string('referelemail')->nullable();
            $table->string('landvalue')->nullable();
            $table->string('landquality')->nullable();
            $table->string('paymentSystem')->nullable();
            $table->string('kistiDuration')->nullable();
            $table->string('bookingcash')->nullable();
            $table->string('total_flat_price')->nullable();
            $table->string('kistypayment')->nullable();
            $table->string('dueamount')->nullable();
            $table->string('fullamount')->nullable();

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
