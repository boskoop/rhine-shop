<?php namespace Rhine\Viewmanagers;

use Laravel\Config;
use Laravel\URI;
use Laravel\URL;

class LanguageManager
{
	
	public function generateLanguageURL($lang)
	{
		$langURI = $lang.'/'.URI::current();
		return URL::to($langURI, null, false, false);
	}

	public function isCurrentLanguage($lang)
	{
		if(Config::get('application.language') == $lang)
		{
			return true;
		}
		return false;
	}

}