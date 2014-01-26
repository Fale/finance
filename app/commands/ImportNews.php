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
        foreach (Stock::all() as $stock) {
            echo $stock->symbol . '... ';
            $notes = $this->import($stock);
            if ($notes) {
                foreach ($notes as $note)
                    if (!Note::where('stock_id', $note->stock_id)
                             ->where('happens_on', $note->happens_on)
                             ->where('extid', $note->extid)
                             ->count())
                        $note->save();
                echo  count($notes) . "\n";
            } else
                echo  "\n";
        }
    }


    public function import($stock)
    {
        $url = 'http://www.google.com/finance/events?q=' . $stock->market->code . ':' . $stock->symbol . '&output=json';
        $file_headers = @get_headers($url);
        if($file_headers[0] == 'HTTP/1.1 404 Not Found' OR
           $file_headers[0] == 'HTTP/1.0 400 Bad Request' OR
           $file_headers[0] == 'HTTP/1.0 500 Internal Server Error')
            return 0;
        $json = file_get_contents($url);
        $json = preg_replace("/([{,])([a-zA-Z][^: ]+):/", "$1\"$2\":", $json);
        $data = json_decode($json);
        $notes = Array();
        if (is_object($data)) {
            if (isset($data->events)) {
                foreach ($data->events as $event) {
                    $note = new Note;
                    $note->title = $event->desc;
                    $note->market_id = $stock->market->id;
                    $note->stock_id = $stock->id;
                    $note->type_id = 5;
                    $note->text = '';
                    $note->happens_on = Carbon::parse($event->start_date);
                    $note->extid = 'google-' . $event->cid;
                    $notes[] = $note;
                }
            }
        }
        sleep(1);
        return $notes;
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
