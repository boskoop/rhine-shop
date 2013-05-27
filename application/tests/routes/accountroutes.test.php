<?php

class AccountRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the account-route.
	 *
	 * @return void
	 */
	public function testAccount()
	{
		$response = $this->httpGet('account');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the login-route.
	 *
	 * @return void
	 */
	public function testLogin()
	{
		$response = $this->httpGet('account/login');
		$this->assertTrue($response->foundation->isOk());
	}

}