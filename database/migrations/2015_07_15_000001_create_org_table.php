<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pb_org', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('mobile');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('pb_cities');

            $table->string('image');
            $table->string('admin_name');
            $table->string('program');
            $table->string('email');
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
        Schema::drop('pb_org');
    }
}
