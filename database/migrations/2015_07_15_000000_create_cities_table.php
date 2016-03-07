<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pb_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sef');
            $table->integer('status');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->string('province');
            $table->integer('country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('pb_cities');
    }
}
