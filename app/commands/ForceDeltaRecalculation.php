<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ForceDeltaRecalculation extends Import {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'recalculate:delta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force the recalculation of delta column';

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
            $stocks = Stock::whereIn('symbol', $this->option('stock'))->get();
        else
            $stocks = Stock::where('active', TRUE)->orderBy('symbol')->get();
        $c = 0;
        $t = count($stocks);
        foreach ($stocks as $stock) {
            $c++;
            echo $c . '/' . $t . ' - ' . $stock->symbol . " ...";
            $pc = 0;
            if ($this->option('from'))
                $vs = Value::where('date', '>=', $this->option('from'))->where('stock_id', $stock->id)->orderBy('date')->get();
            else
                $vs = Value::where('stock_id', $stock->id)->orderBy('date')->get();
            foreach ($vs as $v) {
                if (($pc != 0) && (($v->close - $pc) != 0)) {
                    $v->delta = (($v->close - $pc) / $pc) * 100;
                    $v->save();
                }
                $pc = $v->close;
            }
            echo " done\n";
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
            array('stock', 's', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Stocks to work on'),
            array('from', 'f', InputOption::VALUE_REQUIRED, 'Minimum date to import')
        );
    }

}
