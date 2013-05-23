<?php namespace Rhine\BusinessModels\Impl;

use Rhine\BusinessModels\CartFactory;
use Laravel\IoC;

class IoCCartFactory implements CartFactory
{

	function createCart($positions)
	{
		return IoC::resolve('cart', array($positions));
	}

}
