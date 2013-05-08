<?php

class Product extends Eloquent
{
	
	public function category()
	{
		return $this->belongs_to('Category');
	}

}