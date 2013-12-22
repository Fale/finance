<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportNew extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'import:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data generated after last import.';

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
        $stocks = Stock::get();
        foreach ($stocks as $stock) {
            echo $stock->id . '. ' . $stock->symbol . "...";
            if ($stock->active)
            {
                $imported = $controller->getImport('NASDAQ', $stock->symbol, true);
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
