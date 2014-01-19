<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('text');
			$table->integer('market_id')->unsigned();
			$table->integer('stock_id')->unsigned();
			$table->integer('type_id')->unsigned();
			$table->timestamp('happens_on');
			$table->timestamps();
            $table->foreign('market_id')->references('id')->on('markets');
            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->foreign('type_id')->references('id')->on('note_types');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notes');
	}

}
