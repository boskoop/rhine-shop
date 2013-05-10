<?php namespace Rhine;

use Laravel\IoC;

class RhineIoC
{
	/**
	 * Register and wire objects.
	 */
	public static function init()
	{
		// Viewmanagers
		IoC::singleton('assetManager', function() {
			return new Viewmanagers\AssetManager();
		});

		// Repositories
		IoC::singleton('categoryRepository', function() {
			return new Repositories\Eloquent\EloquentCategoryRepository();
		});
		IoC::singleton('productRepository', function() {
			return new Repositories\Eloquent\EloquentProductRepository();
		});
		IoC::singleton('productImageRepository', function() {
			return new Repositories\Eloquent\EloquentProductImageRepository();
		});

		// Services


		// Actions
		IoC::register('shopGetIndexAction', function() {
			return new Actions\Shop\ShopGetIndexAction(IoC::resolve('categoryRepository'),
					IoC::resolve('productRepository'));
		});
		IoC::register('shopGetCategoryAction', function() {
			return new Actions\Shop\ShopGetCategoryAction(IoC::resolve('categoryRepository'),
					IoC::resolve('productRepository'));
		});
		IoC::register('shopGetProductAction', function() {
			return new Actions\Shop\ShopGetProductAction(IoC::resolve('categoryRepository'),
					IoC::resolve('productRepository'));
		});

		IoC::register('imageGetProductAction', function() {
			return new Actions\Image\ImageGetProductAction(IoC::resolve('productImageRepository'));
		});

		IoC::register('cartGetIndexAction', function() {
			return new Actions\Cart\CartGetIndexAction();
		});

		IoC::register('accountGetIndexAction', function() {
			return new Actions\Account\AccountGetIndexAction();
		});

		IoC::register('informationGetAboutAction', function() {
			return new Actions\Information\InformationGetAboutAction();
		});
	}
}