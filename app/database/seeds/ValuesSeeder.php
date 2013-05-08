<?php

class ValuesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $controller = new StocksController();
        $stocks = Stock::get();
        foreach ($stocks as $stock) {
            echo $stock->id . '. ' . $stock->symbol . "...";
            $imported = $controller->getImport('NASDAQ', $stock->symbol);
            echo " done (" . $imported . " imported)\n";
        }
    }
}