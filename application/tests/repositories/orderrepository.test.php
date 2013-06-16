<?php

use Laravel\IoC;

/**
 * @group integration
 */
class OrderRepositoryTest extends Tests\PersistenceTestCase
{

	private $orderRepository;

	protected function setUpInternal()
	{
		$this->orderRepository = IoC::resolve('orderRepository');
	}

	/**
	 * Tests if findOpenOrdersByUser() returns only orders which are not completed.
	 *
	 * @return void
	 */
	public function testFindOpenOrdersByUser()
	{
		$user = User::create(array('id' => 1));
		Order::create(array('id' => 1,
			'user_id' => 1,
			'shipped_at' => null,
			'paid_at' => null
			));
		Order::create(array('id' => 2,
			'user_id' => 1,
			'shipped_at' => null,
			'paid_at' => time()
			));
		Order::create(array('id' => 3,
			'user_id' => 1,
			'shipped_at' => time(),
			'paid_at' => null
			));
		Order::create(array('id' => 4,
			'user_id' => 1,
			'shipped_at' => time(),
			'paid_at' => time()
			));

		$orders = $this->orderRepository->findOpenOrdersByUser($user);

		$this->assertEquals(2, count($orders));
		$this->assertEquals(2, $orders[0]->id);
		$this->assertEquals(1, $orders[1]->id);
	}

	/**
	 * Tests if findCompletedOrdersByUser() returns only orders which are completed.
	 *
	 * @return void
	 */
	public function testFindCompletedOrdersByUser()
	{
		$user = User::create(array('id' => 1));
		Order::create(array('id' => 1,
			'user_id' => 1,
			'shipped_at' => null,
			'paid_at' => null
			));
		Order::create(array('id' => 2,
			'user_id' => 1,
			'shipped_at' => null,
			'paid_at' => time()
			));
		Order::create(array('id' => 3,
			'user_id' => 1,
			'shipped_at' => time(),
			'paid_at' => null
			));
		Order::create(array('id' => 4,
			'user_id' => 1,
			'shipped_at' => time(),
			'paid_at' => time()
			));

		$orders = $this->orderRepository->findCompletedOrdersByUser($user);

		$this->assertEquals(2, count($orders));
		$this->assertEquals(4, $orders[0]->id);
		$this->assertEquals(3, $orders[1]->id);
	}

}