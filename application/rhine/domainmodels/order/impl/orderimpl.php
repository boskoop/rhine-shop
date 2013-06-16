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
		$this->orderItems = array();
		foreach ($items as $item) {
			$itemBo = new OrderItemImpl($item);
			$this->orderItems[] = $itemBo;
		}
	}

	function getOrderId()
	{
		return $this->order->id;
	}

	function getOrderDate()
	{
		return $this->order->created_at;
	}

	function isPaid()
	{
		if ($this->order->paid_at == null) {
			return false;
		}
		return true;
	}

	function getPaymentDate()
	{
		return $this->order->paid_at;
	}

	function isShipped()
	{
		if ($this->order->shipped_at == null) {
			return false;
		}
		return true;
	}

	function getShippedDate()
	{
		return $this->order->shipped_at;
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

	function getNumberOfItems()
	{
		return count($this->orderItems);
	}

	function payOrder()
	{
		$now = date("Y-m-d H:i:s");
		$this->order->paid_at = $now;
	}

	function resetPayOrder()
	{
		$this->order->paid_at = null;
	}

	function shipOrder()
	{
		$now = date("Y-m-d H:i:s");
		$this->order->shipped_at = $now;
	}

	function resetShipOrder()
	{
		$this->order->shipped_at = null;
	}

}