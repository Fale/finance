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
        return Input::all();

        /*$query = DB::table('node');

        if ($published == true)
            $query->where('published', '=', 1);

        if (isset($year))
            $query->where('year', '>', $year);

        $result = $query->get();*/
    }
}
