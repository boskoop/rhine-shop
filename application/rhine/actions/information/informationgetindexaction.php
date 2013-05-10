<?php namespace Rhine\Actions\Information;

use Laravel\View;

class InformationGetIndexAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('information.index');
	}

}