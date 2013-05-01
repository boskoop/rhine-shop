<?php namespace Rhine;

use Laravel\IoC;

class RhineIoC
{
	/**
	 * Register and wire objects.
	 */
	public static function init()
	{
		// Infrastructure
		IoC::singleton('languageManager', function() {
			return new LanguageManager();
		});

		// Repositories
		IoC::singleton('categoryRepository', function() {
			return new Repositories\Eloquent\EloquentCategoryRepository();
		});

		// Services


		// Actions
		IoC::register('shopGetIndexAction', function() {
			return new Actions\Shop\ShopGetIndexAction(IoC::resolve('categoryRepository'));
		});
	}
}