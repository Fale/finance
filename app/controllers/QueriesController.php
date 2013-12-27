<?php

class QueriesController extends BaseController {

    protected $layout = 'dummy';

    public function getIndex()
    {
        $this->layout->content = View::make('queries/index');
    }

    public function getNew()
    {
        $this->layout->content = View::make('queries/new');
    }

    public function postNew()
    {
        $query = new Query;
        $query->name = Input::get('name');
        $query->filters = Input::get('filters');
        $query->save();
        return Redirect::to('/queries');
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
