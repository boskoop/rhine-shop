<?php

class AddressesTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the Address table attributes.
	 *
	 * @return void
	 */
	public function testAddressAttributes()
	{
		Address::create(array(
			'user_id' => 1,
			'gender_id' => 2,
			'forename' => 'Bart',
			'surname' => 'Simpson',
			'street1' => 'c/o Homer Simpson',
			'street2' => '742 Evergreen Terrace',
			'zip' => '1337',
			'city' => 'Springfield',
			'country' => 'US',
		));

		$address = Address::find(1);
		$this->assertEquals(1, $address->user_id);
		$this->assertEquals(2, $address->gender_id);
		$this->assertEquals('Bart', $address->forename);
		$this->assertEquals('Simpson', $address->surname);
		$this->assertEquals('c/o Homer Simpson', $address->street1);
		$this->assertEquals('742 Evergreen Terrace', $address->street2);
		$this->assertEquals('1337', $address->zip);
		$this->assertEquals('Springfield', $address->city);
		$this->assertEquals('US', $address->country);
	}

	/**
	 * Tests if the user id is unique (a user can only have on address).
	 * 
	 * @expectedException Laravel\Database\Exception
	 * @return void
	 */
	public function testUserIdUnique()
	{
		try {
			Address::create(array(
				'user_id' => 1,
				'gender_id' => 1,
			));
		} catch (Exception $e) {
			$this->fail('Exception not expected here!');
		}
		Address::create(array(
			'user_id' => 1,
			'gender_id' => 2,
		));
	}

	/**
	 * Tests if the gender constants are seeded into the db.
	 * 
	 * @return void
	 */
	public function testGenderSeeded()
	{
		$male = Gender::find(GenderEnum::MALE);
		$this->assertEquals('male', $male->gender);

		$female = Gender::find(GenderEnum::FEMALE);
		$this->assertEquals('female', $female->gender);

		$genders = Gender::all();
		$this->assertEquals(2, sizeof($genders));
	}

}