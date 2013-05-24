<?php namespace Rhine\DomainModels\Cart;

/**
 * A data transfer object for carts.
 */
class CartDto
{

	private $positions = array();

	public static function createEmptyCart()
	{
		return new CartDto();
	}

	public static function createFromCart(Cart $cart)
	{
		$cartDto = new CartDto();
		$positions = $cart->getPositions();
		foreach ($positions as $position) {
			$positionDto = new CartPositionDto($position->getProductId(), $position->getQuantity());
			$cartDto->positions[] = $positionDto;
		}
		return $cartDto;
	}

	public function getPositions()
	{
		return array_merge($this->positions);
	}

}