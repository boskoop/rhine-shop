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
		Asset::add('bootstrap-footer.css', 'css/bootstrap-footer-before-responsive.css');
		Asset::add('bootstrap.js', 'js/bootstrap.min.js');

		// jQuery
		Asset::add('jquery.js', 'js/jquery-1.9.1.min.js');
	}

}