<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportNews extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'import:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import news and calendars from Google and other websites.';

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
        foreach (Stock::take(4)->get() as $stock)
            $this->import($stock);
    }


    public function import($stock)
    {
        $url = 'http://www.google.com/finance/events?q=' . $stock->market->code . ':' . $stock->symbol . '&output=json';
        $file_headers = @get_headers($url);
        if($file_headers[0] == 'HTTP/1.1 404 Not Found' OR $file_headers[0] == 'HTTP/1.0 400 Bad Request')
            return 0;
        $json = file_get_contents($url);
        $json = preg_replace("/([{,])([a-zA-Z][^: ]+):/", "$1\"$2\":", $json);
        $data = json_decode($json);
        var_dump($json);
        var_dump($data);
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
