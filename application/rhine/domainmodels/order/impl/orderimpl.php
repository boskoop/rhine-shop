<?php namespace Rhine\DomainModels\Order\Impl;

use Rhine\Repositories\OrderRepository;
use Rhine\DomainModels\Order\OrderBo;
use Order;

class OrderImpl implements OrderBo
{
	
	private $orderItems;
	private $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
		$this->orderItems = array();
	}

	function getOrderModel()
	{
		return $this->order;
	}

	function setItems(array $items)
	{
		foreach ($items as $item) {
			$itemBo = new OrderItemBo($item);
			$this->orderItems[] = $itemBo;
		}
	}

	function getOrderId()
	{
		return $this->order->id;
	}

	function isPaid()
	{
		if ($this->order->paid_at == null) {
			return true;
		}
		return false;
	}

	function isShipped()
	{
		if ($this->order->shipped_at == null) {
			return true;
		}
		return false;
	}

	function getTotalPrice()
	{
		$totalPrice = 0;
		foreach ($this->orderItems as $item) {
			$itemPrice = $item->getTotalPrice();
			$totalPrice += $itemPrice;
		}
		return $totalPrice;
	}

	function getItems()
	{
		return array_merge($this->orderItems);
	}

	function payOrder()
	{
		$now = date("Y-m-d H:i:s");
		$this->order->paid_at = $now;
	}

	function shipOrder()
	{
		$now = date("Y-m-d H:i:s");
		$this->order->shipped_at = $now;
	}

}