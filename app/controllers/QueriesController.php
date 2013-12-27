<?php

class QueriesController extends BaseController {

    protected $layout = 'dummy';

    public function getIndex()
    {
        $queries = Query::where('owner_id', Session::get('userId'))->get();
        $this->layout->content = View::make('queries/index')->with(array('queries' => $queries));
    }

    public function getNew()
    {
        $this->layout->content = View::make('queries/new');
    }

    public function postNew()
    {
        $query = new Query;
        $query->owner_id = Session::get('userId');
        $query->starred = False;
        $query->name = Input::get('name');
        $query->filters = json_encode(Input::get('filters'));
        $query->execution_times = 0;
        $query->last_executed_at = Carbon::now();
        $query->save();
        return Redirect::to('/queries')->with('message-success', 'Query saved successfully!');
    }

    public function getQuery()
    {
        $qid = Input::get('query');

        $query = DB::table('node');

        foreach( $filters as $filter){
        if ($published == true)
            $query->where('published', '=', 1);

        if (isset($year))
            $query->where('year', '>', $year);
        }
        $result = $query->get();

    }
}
