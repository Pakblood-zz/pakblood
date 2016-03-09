<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pb_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('password', 60);
            $table->string('role')->default('user');
            $table->string('gender');
            $table->string('profile_image');
            $table->date('dob');
            $table->string('phone');
            $table->string('mobile');
            $table->string('address');
            $table->integer('city_id');
            $table->string('blood_group');
            $table->date('last_bleed');
            $table->integer('org_id');
            $table->string('status');
            $table->integer('is_deleted');
            $table->string('gp_id');
            $table->string('fb_id');
            $table->string('confirmation_code');
            $table->timestamp('last_login');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('pb_users');
    }
}
