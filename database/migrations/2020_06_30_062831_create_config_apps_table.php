<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_apps', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('logo_text');
            $table->string('web_app_name');
            $table->string('description_meta');
            $table->string('keyword_meta');
            $table->string('authors_meta');
            $table->string('footer');
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
        Schema::dropIfExists('config_apps');
    }
}
