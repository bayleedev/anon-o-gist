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

	/**
	 * View concern. Helper, presenter, decorator, or view model?
	 */
	public function excerpt()
	{
		$words = explode(' ', $this->body);
		if (count($words) >= 12) {
			$words = array_slice($words, 0, 10);
			$words[] = '&hellip;';
		}
		return implode(' ', $words);
	}

	public function canUpdate()
	{
		return $this->hasPassword() && !$this->isExpired();
	}

	public function hasPassword()
	{
		return !!$this->password;
	}

	public function isExpired()
	{
		$created = strtotime($this->created_at);
		$twoWeeksAgo = strtotime('-2 weeks');
		return $created > $twoWeeksAgo;
	}

}