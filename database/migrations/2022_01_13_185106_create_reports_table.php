<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid')->nullable();
            $table->integer('refereluserid')->nullable();
            $table->string('status')->default('0')->comment('0 for waiting 1 for approve');
            $table->string('date');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('invitedate');
            $table->string('officevisitdate');
            $table->string('sidevisitdate');
            $table->string('counsiling')->nullable();
            $table->string('targetfee')->nullable();
            $table->string('hwant')->nullable();
            $table->string('bthink')->nullable();
            $table->string('mishuk')->nullable();
            $table->string('planshow')->nullable();
            $table->string('training')->nullable();
            $table->string('problem')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
