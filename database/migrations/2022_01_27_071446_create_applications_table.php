<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('auth_id');
            $table->string('referrelID');
            $table->integer('status')->default('0')->comment('0 for pending and 1 for approve');
            $table->string('phonenumber')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nidnumber')->nullable();
            $table->string('dob')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('fathername')->nullable();
            $table->string('mothername')->nullable();
            $table->string('permanentaddress')->nullable();
            $table->string('presentaddress')->nullable();
            $table->string('education')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
