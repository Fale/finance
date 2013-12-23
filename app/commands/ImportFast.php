<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportFast extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'import:fast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data generated of stocks with no values.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        DB::connection()->disableQueryLog();
        $controller = new StocksController();
        $values = Value::groupBy('stock_id')->lists('stock_id');
        $stocks = Stock::where('active', TRUE)->whereNotIn('id', $values)->orderBy('id')->get();
        foreach ($stocks as $stock) {
            echo $stock->id . '. ' . $stock->symbol . "...";
            if ($stock->values()->count() == 0) {
                $imported = $controller->getImport('NASDAQ', $stock->symbol);
                echo " done (" . $imported . " imported)\n";
            } else
                echo " skipped\n";
        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}