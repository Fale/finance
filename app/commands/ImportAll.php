<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportAll extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'import:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Try to re-import all data. Present data will not be duplified.';

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
        $stocks = Stock::where('active', TRUE)->orderBy('id')->get();
        foreach ($stocks as $stock) {
            echo $stock->id . '. ' . $stock->symbol . "...";
            $imported = $controller->getImport('NASDAQ', $stock->symbol);
            echo " done (" . $imported . " imported)\n";
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
