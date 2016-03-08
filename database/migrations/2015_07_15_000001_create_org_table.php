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
            $table->integer('user_id');
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('address');
            $table->string('url');
            $table->string('phone');
            $table->string('mobile');
            $table->integer('city_id');
            $table->string('image');
            $table->string('admin_name');
            $table->string('designation');
            $table->string('email');
            $table->string('application_image');
            $table->string('status');
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
