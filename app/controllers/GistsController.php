<?php

class GistsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /gists
	 *
	 * @return Response
	 */
	public function indexAction()
	{
		return ['gists' => Gist::all()->take(10) ];
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /gists
	 *
	 * @return Response
	 */
	public function store()
	{
		$gist = Gist::create($this->gist_params());
		return Redirect::to("/gist/{$gist->id}")->with('message', 'Gist created!');
	}

	/**
	 * Display the specified resource.
	 * GET /gists/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showAction($id)
	{
		return ['gist' => Gist::find($id)];
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /gists/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$gist = Gist::find($id);
		$gist->update($this->gist_params());
		$gist->save();
		return Redirect::to("/gist/{$gist->id}")->with('message', 'Gist updated!');
	}

	/**
	 * Update the specified resource in storage.
	 * POST /gists/flag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function flag($id)
	{
		$gist = Gist::find($id);
		$gist->flags++;
		$gist->save();
		return Redirect::to("/gist/{$gist->id}")->with('message', 'Gist Flagged!');
	}

	protected function gist_params() {
		return array_filter(array(
			'name' => Request::get('name'),
			'body' => Request::get('body'),
			'password' => Request::get('password'),
			'flags' => 0,
		), function($el) {
			return strlen($el) > 0;
		});
	}

}