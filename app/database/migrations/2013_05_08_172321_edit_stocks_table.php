<?php

use Illuminate\Database\Migrations\Migration;

class EditStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('stocks', function($table) {
            $table->boolean('active');
            $table->date('last');
            $table->integer('value');
        });
        foreach (Stock::get() as $stock)
        	$stock->update(array('active' => true));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stocks', function($table) {
			$table->dropColumn('active');
			$table->dropColumn('last');
			$table->dropColumn('value');
		});
	}

}