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

	/**
	 * Tests the account-profile-route.
	 *
	 * @return void
	 */
	public function testAccountProfile()
	{
		Auth::login(1);

		$response = $this->httpGet('account/profile');
		$this->assertTrue($response->foundation->isOk());
		
		Auth::logout();
	}

	/**
	 * Tests the account-profile-edit-route.
	 *
	 * @return void
	 */
	public function testAccountProfileEdit()
	{
		Auth::login(1);

		$response = $this->httpGet('account/profile/edit');
		$this->assertTrue($response->foundation->isOk());

		Auth::logout();
	}

	/**
	 * Tests the account-address-route.
	 *
	 * @return void
	 */
	public function testAccountAddress()
	{
		Auth::login(1);

		$response = $this->httpGet('account/address');
		$this->assertTrue($response->foundation->isOk());
		
		Auth::logout();
	}

	/**
	 * Tests the account-address-edit-route.
	 *
	 * @return void
	 */
	public function testAccountAddressEdit()
	{
		Auth::login(1);

		$response = $this->httpGet('account/address/edit');
		$this->assertTrue($response->foundation->isOk());
		
		Auth::logout();
	}

}