<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvSreamingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_streamings', function (Blueprint $table) {
            $table->id();
            $table->string('tv_name');
            $table->longText('tv_description');
            $table->text('tv_url_stream');
            $table->boolean('tv_status_active')->default(1);
            $table->string('tv_img');
            $table->string('tv_status_delete')->default(0);
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
        Schema::dropIfExists('tv_streamings');
    }
}
