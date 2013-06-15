<?php

class OrderItem extends Eloquent
{
	
	public function order()
	{
		return $this->belongs_to('Order');
	}

}