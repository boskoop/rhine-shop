<?php namespace Tests\Builder;

use Product;

class ProductBuilder extends Builder {

	private $name;
	private $category_id;
	private $categoryBuilder;
	private $price;
	private $stocksize;

	public function __construct()
	{
		parent::__construct();
		$this->name = 'donald';
		$this->category_id = 1;
		$this->categoryBuilder = null;
		$this->price = 1000;
		$this->stocksize = 0;
	}

	protected function buildInternal(BuilderExtension $extension)
	{
		$product = new Product;
		if (!is_null($this->categoryBuilder))
		{
			$product->category_id = $this->categoryBuilder->buildWith($extension)->id;

		}
		else
		{
			$product->category_id = $this->category_id;
		}
		$product->name = $this->name;
		$product->price = $this->price;
		$product->stocksize = $this->stocksize;
		return $product;
	}

	public function withName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function withCategoryId($category_id)
	{
		$this->category_id = $category_id;
		return $this;
	}

	public function withCategoryBuilder($categoryBuilder)
	{
		$this->categoryBuilder = $categoryBuilder;
		return $this;
	}

	public function withPrice($price)
	{
		$this->price = $price;
		return $this;
	}

	public function withStocksize($stocksize)
	{
		$this->stocksize = $stocksize;
		return $this;
	}

}