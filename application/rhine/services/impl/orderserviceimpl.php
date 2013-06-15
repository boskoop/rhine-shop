<?php namespace Rhine\Services\Impl;

use Rhine\Services\OrderService;
use Rhine\DomainModels\Order\OrderBo;
use Rhine\DomainModels\Order\OrderFactory;
use Rhine\Repositories\OrderRepository;
use User;

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

}