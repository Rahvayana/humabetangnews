<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('genders')->nullable();
            $table->string('phonenumber')->nullable();
            $table->text('password');
            $table->text('api_token');
            $table->string('email')->unique();
            $table->string('provider_id')->unique();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('master_users');
    }
}
