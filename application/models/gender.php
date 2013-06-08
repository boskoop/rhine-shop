<?php

class Gender extends Eloquent
{

	public function addresses()
	{
		return $this->has_many('Address');
	}

}