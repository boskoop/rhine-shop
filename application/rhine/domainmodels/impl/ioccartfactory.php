<?php namespace Rhine\DomainModels\Impl;

use Rhine\DomainModels\CartFactory;
use Laravel\IoC;

class IoCCartFactory implements CartFactory
{

	function createCart($positions)
	{
		return IoC::resolve('cart', array($positions));
	}

}
