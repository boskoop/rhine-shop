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
			return new \Rhine\Language\languageManager();
		});

		// Repositories
		IoC::singleton('categoryRepository', function() {
			return new \Rhine\Repositories\Eloquent\EloquentCategoryRepository();
		});

		// Services


		// Actions
		IoC::register('shopGetIndexAction', function() {
			return new \Rhine\Actions\Shop\ShopGetIndexAction(IoC::resolve('categoryRepository'));
		});
	}
}