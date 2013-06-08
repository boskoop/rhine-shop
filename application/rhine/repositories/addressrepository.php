<?php namespace Rhine\Repositories;

use Address;

interface AddressRepository
{
	/**
	 * Returns the Address of a User.
	 * 
	 * @return Address
	 */
	function findByUserId($userId);

}