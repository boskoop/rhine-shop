<?php

use Rhine\Services\SearchQueryTooShortException;

class SearchQueryTooShortExceptionTest extends Tests\UnitTestCase
{

	public function testException()
	{
		try {
			throw new SearchQueryTooShortException('query');
		} catch (SearchQueryTooShortException $e) {
			$this->assertEquals('query', $e->getQuery());
			$this->assertEquals('The search query is too short', $e->getMessage());
			return;
		}
		$this->fail('this line should not be reached.');
	}

}
