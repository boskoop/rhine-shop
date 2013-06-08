<?php

class UserAddressTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the association between User and Address if the Address is 
	 * inserted to the User.
	 *
	 * @return void
	 */
	public function testOneToOne()
	{
		$user = User::create(array(
			'username' => 'bart',
			'email' => 'bart@simpsons.com',
			'password' => 'secret'
		));
		$address = new Address(array(
			'gender_id' => 1,
			'forename' => 'Bart',
			'surname' => 'Simpson',
			'street1' => 'c/o Homer Simpson',
			'street2' => '742 Evergreen Terrace',
			'zip' => '1337',
			'city' => 'Springfield',
			'country' => 'USA',
		));

		$user->address()->insert($address);

		$address = Address::find(1);
		$this->assertEquals($user->id, $address->user_id);

		$address = User::find(1)->address()->first();
		$this->assertEquals($user->id, $address->user_id);

		$user = Address::find(1)->user()->first();
		$this->assertEquals('bart', $user->username);
	}

}