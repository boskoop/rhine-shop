<?php namespace Rhine\Actions\Information;

use Laravel\View;

class InformationGetAboutAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('information.about');
	}

}