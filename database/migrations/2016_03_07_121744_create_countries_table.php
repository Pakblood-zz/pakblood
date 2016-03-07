<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pb_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso2');
            $table->string('short_name');
            $table->string('long_name');
            $table->string('calling_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pb_countries');
    }
}
