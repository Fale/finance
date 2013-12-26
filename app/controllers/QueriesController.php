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
}
