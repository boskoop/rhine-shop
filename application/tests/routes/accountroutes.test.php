<?php

class AccountRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the account-route when logged out.
	 *
	 * @return void
	 */
	public function testAccountLoggedOut()
	{
		$response = $this->httpGet('account');
		$this->assertTrue($response->foundation->isRedirect());
	}

	/**
	 * Tests the account-route when logged in.
	 *
	 * @return void
	 */
	public function testAccount()
	{
		Auth::login(1);

		$response = $this->httpGet('account');
		$this->assertTrue($response->foundation->isOk());

		Auth::logout();
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