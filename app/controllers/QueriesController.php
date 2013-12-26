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
        $filters = Input::get('filters');

        $this->layout->content = var_dump(Input::get('filters'));
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
