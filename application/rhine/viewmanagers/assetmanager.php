<?php namespace Rhine\Viewmanagers;

use Laravel\Asset;

class AssetManager
{
	/**
	 * Register and wire objects.
	 */
	public function init()
	{
		// Twitter bootstrap
		Asset::add('bootstrap.css', 'css/bootstrap.min.css');
		Asset::add('bootstrap.js', 'js/bootstrap.min.js');
	}

}