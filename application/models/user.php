<?php

class User extends Eloquent
{
	
	public function address()
	{
		return $this->has_one('Address');
	}

	public function orders()
	{
		return $this->has_many('Order');
	}

}