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
		IoC::singleton('addressRepository', function() {
			return new Repositories\Eloquent\EloquentAddressRepository();
		});

		// DomainModels
		IoC::singleton('cartFactory', function() {
			return new DomainModels\Cart\Impl\CartFactoryImpl(IoC::resolve('productRepository'));
		});

		// Services
		IoC::singleton('searchService', function() {
			return new Services\Impl\SearchServiceImpl(IoC::resolve('productRepository'));
		});
		IoC::singleton('cartService', function() {
			return new Services\Impl\CartServiceImpl(IoC::resolve('cartFactory'));
		});

		// Validators
		IoC::singleton('userValidator', function() {
			return new Services\Validators\User\UserValidator();
		});

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
		IoC::register('shopPostProductAction', function() {
			return new Actions\Shop\ShopPostProductAction(IoC::resolve('categoryRepository'),
					IoC::resolve('productRepository'), IoC::resolve('cartService'));
		});
		IoC::register('shopGetSearchAction', function() {
			return new Actions\Shop\ShopGetSearchAction(IoC::resolve('categoryRepository'),
					IoC::resolve('searchService'));
		});

		IoC::register('imageGetProductAction', function() {
			return new Actions\Image\ImageGetProductAction(IoC::resolve('productImageRepository'));
		});

		IoC::register('cartGetIndexAction', function() {
			return new Actions\Cart\CartGetIndexAction(IoC::resolve('cartService'));
		});
		IoC::register('cartPostAddProductAction', function() {
			return new Actions\Cart\CartPostAddProductAction(IoC::resolve('cartService'));
		});
		IoC::register('cartPostSubtractProductAction', function() {
			return new Actions\Cart\CartPostSubtractProductAction(IoC::resolve('cartService'));
		});
		IoC::register('cartPostDeleteProductAction', function() {
			return new Actions\Cart\CartPostDeleteProductAction(IoC::resolve('cartService'));
		});

		IoC::register('accountGetIndexAction', function() {
			return new Actions\Account\AccountGetIndexAction();
		});
		IoC::register('accountGetEditProfileAction', function() {
			return new Actions\Account\AccountGetEditProfileAction();
		});
		IoC::register('accountPostEditProfileAction', function() {
			return new Actions\Account\AccountPostEditProfileAction(IoC::resolve('userValidator'));
		});
		IoC::register('accountGetAddressAction', function() {
			return new Actions\Account\AccountGetAddressAction();
		});
		IoC::register('accountGetLoginAction', function() {
			return new Actions\Account\AccountGetLoginAction();
		});

		IoC::register('informationGetAboutAction', function() {
			return new Actions\Information\InformationGetAboutAction();
		});
		IoC::register('informationGetContactAction', function() {
			return new Actions\Information\InformationGetContactAction();
		});
		IoC::register('informationGetToBAction', function() {
			return new Actions\Information\InformationGetToBAction();
		});
	}
}