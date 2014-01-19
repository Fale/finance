<?php

class NotesController extends BaseController {

	/**
	 * Note Repository
	 *
	 * @var Note
	 */
	protected $note;

	public function __construct(Note $note)
	{
		$this->note = $note;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$notes = $this->note->orderBy('id')->get();

		return View::make('notes.index', compact('notes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('notes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Note::$rules);

		if ($validation->passes())
		{
			$this->note->create($input);

			return Redirect::route('notes.index');
		}

		return Redirect::route('notes.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$note = $this->note->findOrFail($id);

		return View::make('notes.show', compact('note'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$note = $this->note->find($id);

		if (is_null($note))
		{
			return Redirect::route('notes.index');
		}

		return View::make('notes.edit', compact('note'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Note::$rules);

		if ($validation->passes())
		{
			$note = $this->note->find($id);
			$note->update($input);

			return Redirect::route('notes.show', $id);
		}

		return Redirect::route('notes.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->note->find($id)->delete();

		return Redirect::route('notes.index');
	}

}
