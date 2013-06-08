<?php

use Laravel\IoC;

class AddressRepositoryTest extends Tests\PersistenceTestCase
{

	private $addressRepository;

	protected function setUpInternal()
	{
		$this->addressRepository = IoC::resolve('addressRepository');
	}

	/**
	 * Tests if findByCategory() returns Products in order.
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