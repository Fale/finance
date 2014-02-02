<?php

class IndexController extends BaseController {

	public function index()
	{
        $notes = Note::where('happens_on', '>=', Carbon::now())
                     ->where('happens_on', '<=', Carbon::tomorrow())
                     ->orderBy('happens_on')
                     ->orderBy('stock_id')
                     ->get();
		return View::make('index', compact('notes'));
	}

}
