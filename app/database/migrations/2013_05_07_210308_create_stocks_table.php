<?php

use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('stocks', function($table) {
            $table->increments('id');
            $table->integer('market_id')->unsigned();
            $table->string('symbol');
            $table->string('name');
            $table->string('sector');
            $table->string('industry');
            $table->string('url');
            $table->foreign('market_id')->references('id')->on('markets');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stocks');
	}

}