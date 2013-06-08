<?php namespace Rhine\Repositories\Eloquent;

use Address;
use Rhine\Repositories\AddressRepository;

class EloquentAddressRepository implements AddressRepository
{
	
	function findByUserId($userId)
	{
		return Address::where('user_id', '=', $userId)->first();
	}

}