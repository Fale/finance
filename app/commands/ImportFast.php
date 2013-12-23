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
    protected $description = 'Command description.';

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
        $stocks = Stock::get()->where('active', TRUE);
        foreach ($stocks as $stock) {
            echo $stock->id . '. ' . $stock->symbol . "...";
            if ($stock->values != NULL) {
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
        return array(
            array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}