<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class dbfix extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix the db (v1 -> v2).';

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
        if ($this->option('all'))
            while (Value::where('delta', NULL)->count() > 0)
                $this->parse();
        else
            $this->parse();
    }

    public function parse()
    {
        if ($this->option('all'))
            $values = Value::where('delta', NULL)->limit(100)->orderBy('date', 'desc')->get();
        else
            $values = Value::where('delta', NULL)->where('date', '>', '2014-01-01')->orderBy('date', 'desc')->get();
        foreach ($values as $v)
        {
            echo $v->stock->symbol . ": " . $v->date . "\n";
            $p = Value::where('stock_id', $v->stock->id)->where('date', '<', $v->date)->orderBy('date', 'desc')->pluck('close');
            if ($p)
                $v->delta = (($v->close - $p) / $p) * 100;
            else
                $v->delta = 0;
            if ($v->indexa == 0)
                $v->indexa = floor((($v->close + $v->open) * $v->volume) / 2 / 5000);
            $v->save();
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
            array('all', 'a', InputOption::VALUE_NONE, 'Fix old data too')
        );
    }

}
