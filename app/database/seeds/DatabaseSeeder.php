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
		$this->call('ValuesSeeder');
	}

}