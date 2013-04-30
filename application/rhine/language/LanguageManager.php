<?php namespace Rhine\Language;

use Laravel\Session;
use Laravel\Request;
use Laravel\Config;

class LanguageManager
{
	
	static function detectLanguage()
	{
		// Set default session language if none is set
		if(!Session::has('language'))
		{

			// detect browser language
			if(Request::server('http_accept_language'))
			{
				$headerlang = substr(Request::server('http_accept_language'), 0, 2);

				if(in_array($headerlang, Config::get('application.languages')))
				{
					// browser lang is supported, use it
					$lang = $headerlang;
				}
				else // use default application lang
				{
					$lang = Config::get('application.language');
				}
			}
			// no lang in uri nor in browser. use default
			else 
			{
				// use default application lang
				$lang = Config::get('application.language');            
			}

			// set application language for that user
			Session::put('language', $lang);
			Config::set('application.language',  $lang);
		}
		else // session is available
		{
			// set application to session lang
			Config::set('application.language', Session::get('language'));
		}

	}

	static function setSessionLanguage($lang)
	{
		if(!in_array($lang, Config::get('application.languages')))
		{
			//$lang = Config::get('application.language');
		}
		Session::put('language', $lang);
	}

	static function isSessionLanguage($lang)
	{
		if(Session::get('language') == $lang)
		{
			return true;
		}
		return false;
	}

}