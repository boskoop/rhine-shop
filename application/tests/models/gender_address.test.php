<?php

class GenderAddressTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the association between Gender and Address.
	 *
	 * @return void
	 */
	public function testOneToOne()
	{
		$gender = Gender::find(GenderEnum::MALE);
		$address = new Address(array(
			'user_id' => 1,
			'forename' => 'Bart',
			'surname' => 'Simpson',
			'street1' => 'c/o Homer Simpson',
			'street2' => '742 Evergreen Terrace',
			'zip' => '1337',
			'city' => 'Springfield',
			'country' => 'US',
		));

		$gender->addresses()->insert($address);

		$address = Address::find(1);
		$this->assertEquals($gender->id, $address->gender_id);

		$address = Gender::find(GenderEnum::MALE)->addresses()->first();
		$this->assertEquals($gender->id, $address->gender_id);

		$gender = Address::find(1)->gender()->first();
		$this->assertEquals(GenderEnum::MALE, $gender->id);
	}

}