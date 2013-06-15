<?php

/**
 * @group integration
 */
class OrdersTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the Order table attributes.
	 *
	 * @return void
	 */
	public function testOrderAttributes()
	{
		$created = new DateTime('2010-01-01');
		$paid = new DateTime('2010-01-02');
		$shipped = new DateTime('2010-01-03');

		$order = Order::create(array('id' => 1,
			'user_id' => 1,
			'paid_at' => $paid,
			'shipped_at' => $shipped,
		));
		// We have to manually set the created_at because
		// it is overrriden when inserted to db!
		$order->created_at = $created;
		$order->save();

		$order = Order::find(1);
		$this->assertEquals(1, $order->user_id);
		$this->assertEquals($paid->getTimestamp(), strtotime($order->paid_at));
		$this->assertEquals($shipped->getTimestamp(), strtotime($order->shipped_at));
		$this->assertEquals($created->getTimestamp(), strtotime($order->created_at));
	}

	/**
	 * Tests the OrderItem table attributes.
	 *
	 * @return void
	 */
	public function testOrderItemAttributes()
	{
		OrderItem::create(array('id' => 1,
			'order_id' => 2,
			'product_name' => 'donald',
			'category_name' => 'comic',
			'price' => 200,
			'quantity' => 5,
		));

		$orderItem = OrderItem::find(1);
		$this->assertEquals(2, $orderItem->order_id);
		$this->assertEquals('donald', $orderItem->product_name);
		$this->assertEquals('comic', $orderItem->category_name);
		$this->assertEquals(200, $orderItem->price);
		$this->assertEquals(5, $orderItem->quantity);
	}

	/**
	 * Tests the association between User and Order.
	 *
	 * @return void
	 */
	public function testUserOrderOneToMany()
	{
		$user = User::create(array(
			'id' => 5,
			'username' => 'bart'
		));
		$order = new Order(array('id' => 10));

		$user->orders()->insert($order);

		$order = Order::find(10);
		$this->assertEquals($user->id, $order->user_id);

		$order = User::find(5)->orders()->first();
		$this->assertEquals($user->id, $order->user_id);

		$user = Order::find(10)->user()->first();
		$this->assertEquals('bart', $user->username);
	}

	/**
	 * Tests the association between Order and OrderItem.
	 *
	 * @return void
	 */
	public function testOrderOrderItemOneToMany()
	{
		$order = Order::create(array(
			'id' => 5,
			'user_id' => 8
		));
		$orderItem = new OrderItem(array('id' => 20));

		$order->items()->insert($orderItem);

		$orderItem = OrderItem::find(20);
		$this->assertEquals($order->id, $orderItem->order_id);

		$orderItem = Order::find(5)->items()->first();
		$this->assertEquals($order->id, $orderItem->order_id);

		$order = OrderItem::find(20)->order()->first();
		$this->assertEquals(8, $order->user_id);
	}

	/**
	 * Tests if orders are not shipped by default
	 *
	 * @return void
	 */
	public function testOrderNotShipped()
	{
		$order = Order::create(array(
			'id' => 5
		));
		$order = Order::find(5);

		$this->assertEquals(null, $order->shipped_at);
	}

	/**
	 * Tests if orders are not paid by default
	 *
	 * @return void
	 */
	public function testOrderNotPaid()
	{
		$order = Order::create(array(
			'id' => 5
		));
		$order = Order::find(5);

		$this->assertEquals(null, $order->paid_at);
	}

}