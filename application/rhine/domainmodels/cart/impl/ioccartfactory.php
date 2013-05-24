<?php namespace Rhine\DomainModels\Cart\Impl;

use Rhine\DomainModels\Cart\CartFactory;
use Laravel\IoC;

class IoCCartFactory implements CartFactory
{

	function createCart($positions)
	{
		return IoC::resolve('cart', array($positions));
	}

}
