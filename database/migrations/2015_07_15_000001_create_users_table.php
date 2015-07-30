<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pb_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password', 60);
            $table->string('name');
            $table->string('gender');
            $table->date('dob');
            $table->string('phone');
            $table->string('address');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('pb_cities');

            $table->string('blood_group');
            $table->date('last_bleed');
            $table->integer('org_id');
            $table->string('status');
            $table->string('account_status');
            $table->integer('fb_id');
            $table->rememberToken();
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
        Schema::drop('pb_users');
    }
}
