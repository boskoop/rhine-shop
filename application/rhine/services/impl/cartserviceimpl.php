<?php namespace Rhine\Services\Impl;

use Rhine\Services\CartService;

class CartServiceImpl implements CartService
{

	public function addToCart($productId)
	{
		// dummy implemation, does nothing
	}

	public function cartEmpty()
	{
		return true;
	}

}