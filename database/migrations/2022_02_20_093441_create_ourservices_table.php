<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ourservices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->text('desc');
            $table->integer('status')->default(0)->comment('0 for active 1 for inactive');
            $table->integer('is_featured')->default(0)->comment('0 for active 1 for inactive');
            $table->timestamps();
        });

        Schema::create('ourserviceshead', function (Blueprint $table) {
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
        Schema::dropIfExists('ourservices');
        Schema::dropIfExists('ourserviceshead');
    }
}
