<?php namespace Rhine\DomainModels\Cart;

class CartPositionDto
{

	private $id;
	private $quantity;

	public function __construct($id, $quantity)
	{
		$this->id = $id;
		$this->quantity = $quantity;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getQuantity()
	{
		return $this->quantity;
	}
	
}