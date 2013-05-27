<?php

class InformationRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the information-route.
	 *
	 * @return void
	 */
	public function testInformationHome()
	{
		$response = $this->httpGet('information');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the about-route.
	 *
	 * @return void
	 */
	public function testInformationAbout()
	{
		$response = $this->httpGet('information/about');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the contact-route.
	 *
	 * @return void
	 */
	public function testInformationContact()
	{
		$response = $this->httpGet('information/contact');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the tob-route.
	 *
	 * @return void
	 */
	public function testInformationTob()
	{
		$response = $this->httpGet('information/tob');
		$this->assertTrue($response->foundation->isOk());
	}

}