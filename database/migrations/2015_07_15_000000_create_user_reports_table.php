<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pb_user_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reported_user_id');
            $table->integer('reporter_user_id');
            $table->string('reporter_user_ip');
            $table->string('reporter_name');
            $table->string('reporter_email');
            $table->string('reporter_message');
            $table->string('type');
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
        Schema::drop('pb_user_reports');
    }
}
