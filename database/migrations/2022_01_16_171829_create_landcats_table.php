<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landcats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mainland')->nullable();
            $table->string('utility')->nullable();
            $table->string('usedland')->nullable();
            $table->string('plotnumber')->nullable();
            $table->string('floornumber')->nullable();
            $table->string('unitnumber')->nullable();
            $table->string('totalsquarefit')->nullable();
            $table->string('floatratio')->nullable();
            $table->integer('status')->default('0')->comment('0 for active 1 for inactive');
            $table->string('csnumber')->nullable();
            $table->string('sanumber')->nullable();
            $table->string('rsnumber')->nullable();
            $table->string('bsnumber')->nullable();
            $table->string('jlnumber')->nullable();
            $table->string('dcrnumber')->nullable();
            $table->string('kharicaseno')->nullable();
            $table->string('khajnayear')->nullable();
            $table->string('maindolilnumber')->nullable();
            $table->string('vayanumber')->nullable();
            $table->string('lanbdescription')->nullable();
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
        Schema::dropIfExists('landcats');
    }
}
