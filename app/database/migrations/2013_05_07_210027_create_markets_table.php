<?php

use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('markets', function($table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('markets');
	}

}