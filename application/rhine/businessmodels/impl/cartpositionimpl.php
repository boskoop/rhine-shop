<?php namespace Rhine\BusinessModels\Impl;

use Rhine\Repositories\ProductRepository;
use Rhine\BusinessModels\CartPosition;

class CartPositionImpl implements CartPosition
{

	private $productRepository;

	private $id;
	private $product;

	private $quantity;

	public function __construct($id, ProductRepository $productRepository, $quantity = 1)
	{
		$this->productRepository = $productRepository;
		$this->id = $id;
		$this->quantity = $quantity;
		$this->product = null;
	}

	public function getProductId()
	{
		return $this->id;
	}

	public function getProduct()
	{
		if ($this->product == null) {
			$this->product = $this->productRepository->findById($this->id);
		}
		return $this->product;
	}

	public function getQuantity()
	{
		return $this->quantity;
	}

	public function getUnitPrice()
	{
		$product = $this->getProduct();
		if ($product == null) {
			return 0;
		}
		return $product->price;
	}

	public function getTotalPrice()
	{
		return $this->getQuantity() * $this->getUnitPrice();
	}


}
