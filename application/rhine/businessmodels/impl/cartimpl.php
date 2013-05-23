<?php namespace Rhine\BusinessModels\Impl;

use Rhine\Repositories\ProductRepository;
use Rhine\BusinessModels\Cart;

class CartImpl implements Cart
{

	private $productRepository;
	private $positions;

	public function __construct(ProductRepository $productRepository, $positions = array())
	{
		$this->productRepository = $productRepository;
		$this->positions = array();
		foreach ($positions as $key => $quantity) {
			$this->addPositionWithQuantity(intval($key), $quantity);
		}
	}

	public function isEmpty()
	{
		if (count($this->positions) <= 0) {
			return true;
		}
		return false;
	}


	public function getPositions()
	{
		return array_merge($this->positions);
	}
	
	public function getTotalPrice()
	{
		$price = 0;
		foreach ($this->positions as $position) {
			$price += $position->getTotalPrice();
		}
		return $price;
	}
	
	public function addPosition($productId)
	{
		$this->addPositionWithQuantity($productId, 1);
	}

	private function addPositionWithQuantity($productId, $quantity)
	{
		$key = $this->getPositionKey($productId);
		if(array_key_exists($key, $this->positions)) {
			$this->positions[$key]->incrementQuantity();
		} else {
			$position = new CartPositionImpl($productId, $this->productRepository, $quantity);
			$this->positions[$key] = $position;
		}
	}

	public function removePosition($productId)
	{
		$key = $this->getPositionKey($productId);
		if(array_key_exists($key, $this->positions)) {
			$this->positions[$key]->decrementQuantity();
			if($this->positions[$key]->getQuantity() <= 0) {
				unset($this->positions[$key]);
			}
			return true;
		}
		return false;
	}

	public function clearPosition($productId)
	{
		$key = $this->getPositionKey($productId);
		unset($this->positions[$key]);
	}

	public function clear()
	{
		$this->positions = array();
	}

	private function getPositionKey($productId)
	{
		return strval($productId);
	}

}
