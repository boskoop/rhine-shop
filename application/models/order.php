<?php

class Order extends Eloquent
{
	
	public function user()
	{
		return $this->belongs_to('User');
	}

	public function items()
	{
		return $this->has_many('OrderItem');
	}

}