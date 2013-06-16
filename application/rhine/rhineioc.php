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
		IoC::singleton('orderRepository', function() {
			return new Repositories\Eloquent\EloquentOrderRepository();
		});

		// DomainModels
		IoC::singleton('cartFactory', function() {
			return new DomainModels\Cart\Impl\CartFactoryImpl(IoC::resolve('productRepository'));
		});
		IoC::singleton('orderFactory', function() {
			return new DomainModels\Order\Impl\OrderFactoryImpl();
		});

		// Services
		IoC::singleton('searchService', function() {
			return new Services\Impl\SearchServiceImpl(IoC::resolve('productRepository'));
		});
		IoC::singleton('cartService', function() {
			return new Services\Impl\CartServiceImpl(IoC::resolve('cartFactory'));
		});
		IoC::singleton('orderService', function() {
			return new Services\Impl\OrderServiceImpl(IoC::resolve('orderFactory'),
				IoC::resolve('orderRepository'));
		});
		IoC::singleton('pdfService', function() {
			return new Services\Impl\PdfServiceImpl();
		});

		// Validators
		IoC::singleton('userValidator', function() {
			return new Services\Validators\Account\UserValidator();
		});
		IoC::singleton('addressValidator', function() {
			return new Services\Validators\Account\AddressValidator();
		});
		IoC::singleton('captchaValidator', function() {
			return new Services\Validators\Account\CaptchaValidator();
		});

		// Actions
		// - Shop
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

		// - Image
		IoC::register('imageGetProductAction', function() {
			return new Actions\Image\ImageGetProductAction(IoC::resolve('productImageRepository'));
		});

		// - Cart
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
		IoC::register('cartGetCheckoutAction', function() {
			return new Actions\Cart\CartGetCheckoutAction(IoC::resolve('cartService'),
				IoC::resolve('addressRepository'));
		});
		IoC::register('cartPostCheckoutAction', function() {
			return new Actions\Cart\CartPostCheckoutAction(IoC::resolve('cartService'),
				IoC::resolve('orderService'));
		});

		// - Account
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
			return new Actions\Account\AccountGetAddressAction(IoC::resolve('addressRepository'));
		});
		IoC::register('accountGetEditAddressAction', function() {
			return new Actions\Account\AccountGetEditAddressAction(IoC::resolve('addressRepository'));
		});
		IoC::register('accountPostEditAddressAction', function() {
			return new Actions\Account\AccountPostEditAddressAction(IoC::resolve('addressRepository'), IoC::resolve('addressValidator'));
		});
		IoC::register('accountGetLoginAction', function() {
			return new Actions\Account\AccountGetLoginAction();
		});
		IoC::register('accountGetRegisterAction', function() {
			return new Actions\Account\AccountGetRegisterAction();
		});
		IoC::register('accountPostRegisterAction', function() {
			return new Actions\Account\AccountPostRegisterAction(IoC::resolve('userValidator'),
					IoC::resolve('addressValidator'), IoC::resolve('captchaValidator'));
		});
		IoC::register('accountGetDeleteProfileAction', function() {
			return new Actions\Account\AccountGetDeleteProfileAction();
		});
		IoC::register('accountPostDeleteProfileAction', function() {
			return new Actions\Account\AccountPostDeleteProfileAction(IoC::resolve('userValidator'),
					IoC::resolve('captchaValidator'));
		});
		IoC::register('accountGetOrdersAction', function() {
			return new Actions\Account\AccountGetOrdersAction(IoC::resolve('orderService'));
		});
		IoC::register('accountGetOrderHistoryAction', function() {
			return new Actions\Account\AccountGetOrderHistoryAction(IoC::resolve('orderService'));
		});
		IoC::register('accountGetOrderPdfAction', function() {
			return new Actions\Account\AccountGetOrderPdfAction(IoC::resolve('orderService'),
				IoC::resolve('pdfService'));
		});

		// - Information
		IoC::register('informationGetAboutAction', function() {
			return new Actions\Information\InformationGetAboutAction();
		});
		IoC::register('informationGetContactAction', function() {
			return new Actions\Information\InformationGetContactAction();
		});
		IoC::register('informationGetToBAction', function() {
			return new Actions\Information\InformationGetToBAction();
		});

		// - Admin
		IoC::register('adminGetOrdersAction', function() {
			return new Actions\Admin\AdminGetOrdersAction(IoC::resolve('orderService'));
		});
		IoC::register('adminPostPayOrderAction', function() {
			return new Actions\Admin\AdminPostPayOrderAction(IoC::resolve('orderService'));
		});
		IoC::register('adminPostShipOrderAction', function() {
			return new Actions\Admin\AdminPostShipOrderAction(IoC::resolve('orderService'));
		});
		IoC::register('adminPostDeleteOrderAction', function() {
			return new Actions\Admin\AdminPostDeleteOrderAction(IoC::resolve('orderRepository'));
		});
		IoC::register('adminGetCategoriesAction', function() {
			return new Actions\Admin\AdminGetCategoriesAction(IoC::resolve('categoryRepository'));
		});
	}
}