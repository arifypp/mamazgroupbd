<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_settings', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->string('title')->nullable();
            $table->string('seotitle')->nullable();
            $table->string('phone')->nullable();
            $table->text('metadesc')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('email')->nullable();
            $table->string('sendername')->nullable();
            $table->string('emailencryption')->nullable();
            $table->string('SMTPhost')->nullable();
            $table->string('SMTPport')->nullable();
            $table->string('SMTPusername')->nullable();
            $table->string('SMTPpassword')->nullable();
            $table->string('Emailcharset')->nullable();
            $table->string('Emailsignature')->nullable();
            $table->string('websitelogowhite')->nullable();
            $table->string('websitelogodark')->nullable();
            $table->string('websitefaviconwhite')->nullable();
            $table->string('websitefavicondark')->nullable();
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
        Schema::dropIfExists('platform_settings');
    }
}
