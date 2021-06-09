<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('news_title');
            $table->bigInteger('category_id')->index();
            $table->bigInteger('users_id')->index();
            $table->boolean('news_status_active')->default(0);
            $table->boolean('news_status_slideshow')->default(0);
            $table->longText('news_content');
            $table->string('news_img');
            $table->string('news_video');
            $table->dateTime('news_publish_datetime');
            $table->boolean('news_status_delete')->default(0);
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
        Schema::dropIfExists('news');
    }
}
