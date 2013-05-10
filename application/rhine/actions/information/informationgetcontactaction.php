<?php namespace Rhine\Actions\Information;

use Laravel\View;

class InformationGetContactAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('information.contact');
	}

}