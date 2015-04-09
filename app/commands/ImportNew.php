<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportNew extends Import {

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
        if ($this->option('stock'))
            $stocks = Stock::where('symbol', $this->option('stock'))->get();
        else
            $stocks = Stock::where('active', TRUE)->orderBy('symbol')->get();
        $c = 0;
        $t = count($stocks);
        foreach ($stocks as $stock) {
            $c++;
            echo $c . '/' . $t . ' - ' . $stock->symbol . " ...";
            $imported = $this->getImport('NASDAQ', $stock->symbol, TRUE);
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
        return array(
            array('stock', 's', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Stocks to work on')
        );
    }

}
