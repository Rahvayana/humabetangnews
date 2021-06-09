<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsUserComentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_user_coments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->index();
            $table->bigInteger('news_id')->index();
            $table->text('text_coment');
            $table->boolean('status_delete_coment')->default(0);

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
        Schema::dropIfExists('news_user_coments');
    }
}
