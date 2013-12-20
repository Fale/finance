<?php

class ValuesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection()->disableQueryLog();
        $controller = new StocksController();
        $stocks = Stock::get();
        foreach ($stocks as $stock) {
            echo $stock->id . '. ' . $stock->symbol . "...";
            if ($stock->active)
            {
                $imported = $controller->getImport('NASDAQ', $stock->symbol);
                echo " done (" . $imported . " imported)\n";
            } else
                echo " skipped\n";
        }
    }
}
