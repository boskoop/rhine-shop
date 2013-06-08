<?php

class Address extends Eloquent
{
	
	public function user()
	{
		return $this->belongs_to('User');
	}
	
	public function gender()
	{
		return $this->belongs_to('Gender');
	}

}