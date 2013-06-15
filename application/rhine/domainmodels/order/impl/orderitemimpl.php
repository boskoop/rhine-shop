<?php namespace Rhine\DomainModels\Order\Impl;

use Rhine\DomainModels\Order\OrderItemBo;
use OrderItem;

class OrderItemImpl implements OrderItemBo
{

	private $orderItem;

	public function __construct(OrderItem $orderItem)
	{
		$this->orderItem = $orderItem;
	}

	function getProductName()
	{
		return $this->orderItem->product_name;
	}

	function getCategoryName()
	{
		return $this->orderItem->category_name;
	}

	function getQuantity()
	{
		return $this->orderItem->quantity;
	}

	function getUnitPrice()
	{
		return $this->orderItem->price;
	}

	function getTotalPrice()
	{
		$totalPrice = $this->orderItem->quantity * $this->orderItem->price;
		return $totalPrice;
	}

}