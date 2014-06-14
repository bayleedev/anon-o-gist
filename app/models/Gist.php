<?php

class Gist extends \LaravelBook\Ardent\Ardent {

	public static $unguarded = true;

	protected $fillable = [];

	protected $attributes = [
		'flags' => 0,
		'password' => '',
	];

	public static $rules = [
		'name'      => 'required|between:4,16',
		'body'      => 'required',
		'password'  => 'alpha_num',
	];

}