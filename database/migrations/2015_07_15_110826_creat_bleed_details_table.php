<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatBleedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pb_bleed_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('receiver_name',100);
            $table->string('city',100);
            $table->string('comments');
            $table->date('date');
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
        Schema::drop('pb_bleed_details');
    }
}
