<?php

/**
 * @group endtoend
 */
class SearchRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the search-route.
	 *
	 * @return void
	 */
	public function testSearch()
	{
		$response = $this->httpGet('search/abc');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the search-query-route.
	 *
	 * @return void
	 */
	public function testSearchQueryRedirect()
	{
		$response = $this->httpPost('search', array('query' => 'abc'));
		$this->assertTrue($response->foundation->isRedirect());
	}

}