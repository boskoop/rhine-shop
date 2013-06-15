<?php

use Laravel\IoC;

/**
 * @group integration
 */
class AddressRepositoryTest extends Tests\PersistenceTestCase
{

	private $addressRepository;

	protected function setUpInternal()
	{
		$this->addressRepository = IoC::resolve('addressRepository');
	}

	/**
	 * Tests if testFindByUserId() returns the address for the correct user.
	 *
	 * @return void
	 */
	public function testFindByUserId()
	{
		Address::create(array('user_id' => 1,
			'forename' => 'homer'
		));
		Address::create(array('user_id' => 2,
			'forename' => 'marge'
		));

		$address = $this->addressRepository->findByUserId(1);
		$this->assertEquals('homer', $address->forename);

		$address = $this->addressRepository->findByUserId(2);
		$this->assertEquals('marge', $address->forename);

		$address = $this->addressRepository->findByUserId(3);
		$this->assertNull($address);
	}

}