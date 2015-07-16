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
            $table->integer('donor_user_id');
            $table->integer('receiver_user_id');
            $table->integer('city_id');
            $table->integer('wish_id');
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
