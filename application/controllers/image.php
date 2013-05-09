<?php

class Image_Controller extends Base_Controller
{

	public function action_product($id)
	{
		$action = IoC::resolve('imageGetProductAction');
		return $action->execute($id);
	}

}