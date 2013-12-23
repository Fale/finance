<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DbClean extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean common mistakes from the DB.';

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
        $stocks = Stock::get();
        foreach ($stocks as $stock) {
            if ($stock->symbol != trim($stock->symbol)) {
                $stock->symbol = trim($stock->symbol);
                $stock->save();
            }
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