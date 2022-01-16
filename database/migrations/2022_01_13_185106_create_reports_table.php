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
            $table->string('date');
            $table->string('name')->nullable();
            $table->tinyInteger('phone')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('invitedate');
            $table->string('officevisitdate');
            $table->string('sidevisitdate');
            $table->string('counsiling')->nullable();
            $table->string('targetfee')->nullable();
            $table->tinyInteger('hwant')->nullable();
            $table->tinyInteger('bthink')->nullable();
            $table->tinyInteger('mishuk')->nullable();
            $table->tinyInteger('planshow')->nullable();
            $table->tinyInteger('training')->nullable();
            $table->tinyInteger('problem')->nullable();
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
