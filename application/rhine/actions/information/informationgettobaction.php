<?php namespace Rhine\Actions\Information;

use Laravel\View;

class InformationGetToBAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('information.tob');
	}

}