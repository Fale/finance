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
        $values = Value::groupBy('stock_id')->lists('stock_id');
        $stocks = Stock::where('active', TRUE)->whereNotIn('id', $values)->orderBy('symbol')->get();
        $c = 0;
        $t = count($stocks);
        $pc = 0;
        foreach ($stocks as $stock) {
            $c++;
            echo $c . '/' . $t . ' - ' . $stock->symbol . " ...";
            $vs = Value::where('stock_id', $stock->id)->orderBy('date');
            foreach ($vs as $v) {
                if ($pc != 0 && $v['close'] - $pc != 0)
                    $v->delta = (($v->close - $pc) / $pc) * 100;
                    $v->save();
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
        return array();
    }

}
