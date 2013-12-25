<?php

class QueriesController extends BaseController {

	protected $layout = 'dummy';

	public function getIndex()
	{
		$this->layout->content = 'Hi';
	}

}
