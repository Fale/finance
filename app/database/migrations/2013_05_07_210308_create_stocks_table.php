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
            $table->boolean('active')->default('true');
            $table->date('last')->default('1970-01-01');
            $table->double('value', 9, 5)->default('0000.00000');
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
