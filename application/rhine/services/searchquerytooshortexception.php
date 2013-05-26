<?php namespace Rhine\Services;

class SearchQueryTooShortException extends \Exception
{

	private $query;

	public function __construct($query)
	{
		parent::__construct('The search query is too short');
		$this->query = $query;
	}

	public function getQuery()
	{
		return $this->query;
	}

}