<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		if (!Market::count())
			$this->call('MarketsSeeder');
		if (!Stock::count())
			$this->call('StocksSeeder');
		if (!Value::count())
			$this->call('ValuesSeeder');
		if (!User::count())
			$this->call('UsersSeeder');
		$this->call('NotesTableSeeder');
	}

}