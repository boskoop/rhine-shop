<?php namespace Rhine\Actions\Cart;

use Laravel\View;

class CartGetIndexAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('cart.index');
	}

}