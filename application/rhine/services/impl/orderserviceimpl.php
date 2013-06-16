<?php namespace Rhine\Services\Impl;

use Rhine\Services\OrderService;
use Rhine\Services\OrderNotFoundException;
use Rhine\DomainModels\Order\OrderBo;
use Rhine\DomainModels\Order\OrderFactory;
use Rhine\Repositories\OrderRepository;
use User;
use Order;
use OrderItem;
use Rhine\DomainModels\Cart\CartBo;

class OrderServiceImpl implements OrderService
{

	private $orderFactory;
	private $orderRepository;

	public function __construct(OrderFactory $orderFactory,
		OrderRepository $orderRepository)
	{
		$this->orderFactory = $orderFactory;
		$this->orderRepository = $orderRepository;

	}

	public function loadOpenOrdersFor(User $user)
	{
		$orders = array();

		$dbOrders = $this->orderRepository->findOpenOrdersByUser($user);
		foreach ($dbOrders as $dbOrder) {
			$bo = $this->orderFactory->createFromOrder($dbOrder);
			$orders[] = $bo;
		}

		return $orders;
	}

	public function loadCompletedOrdersFor(User $user)
	{
		$orders = array();

		$dbOrders = $this->orderRepository->findCompletedOrdersByUser($user);
		foreach ($dbOrders as $dbOrder) {
			$bo = $this->orderFactory->createFromOrder($dbOrder);
			$orders[] = $bo;
		}

		return $orders;
	}

	public function loadOrderFor(User $user, $orderId)
	{
		$dbOrder = null;
		if ($user->isAdmin()) {
			$dbOrder = $this->orderRepository->findById($orderId);
		} else {
			$dbOrder = $this->orderRepository->findByIdAndUser($orderId, $user);
		}
		if ($dbOrder == null) {
			throw new OrderNotFoundException();
		}
		$order = $this->orderFactory->createFromOrder($dbOrder);
		return $order;
	}

	public function placeOrder(User $user, CartBo $cart)
	{
		$order = new Order(array('paid_at' => null,
			'shipped_at' => null));
		$orderItems = array();
		foreach ($cart->getPositions() as $position) {
			// Todo: refactor to use a repository
			$product = $position->getProduct();
			$product->stocksize -= $position->getQuantity();
			$product->save();

			$category = $product->category()->first();
			$item = new OrderItem(array('product_name' => $product->name,
				'category_name' => $category->name,
				'price' => $position->getUnitPrice(),
				'quantity' => $position->getQuantity()));
			$orderItems[] = $item;
		}
		$this->orderRepository->persistOrder($user, $order, $orderItems);
	}

	public function loadOrdersPaginated()
	{
		$orders = array();

		$dbOrders = $this->orderRepository->findAllOrdersDescPaginated();
		foreach ($dbOrders->results as $dbOrder) {
			$bo = $this->orderFactory->createFromOrder($dbOrder);
			$orders[] = $bo;
		}
		$dbOrders->results = $orders;
		return $dbOrders;
	}

}