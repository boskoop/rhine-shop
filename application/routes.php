<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Shop routes
Route::get('/', array('as' => 'home', 'uses' => 'shop@index'));
Route::get('shop', array('as' => 'shop', 'uses' => 'shop@index'));
Route::get('category/(:num)', array('as' => 'category', 'uses' => 'shop@category'));

// Image routes
Route::get('product/(:num)/image.png', array('after' => 'image', 'as' => 'product_image', 'uses' => 'image@product'));

// Search routes
Route::get('search/(.*)', array('as' => 'search', 'uses' => 'shop@search'));
Route::post('search', array('as' => 'searchaction', function()
	{
		$query = Input::get('query');
		$query = str_replace(' ', '/', $query);
		return Redirect::to_route('search', $query);
	}));

// Product routes
Route::get('product/(:num)', array('as' => 'product', 'uses' => 'shop@product'));
Route::post('product/(:num)', array('as' => 'addproduct', 'uses' => 'shop@addtocart'));

// Cart routes
Route::get('cart', array('as' => 'cart', 'uses' => 'cart@index'));
Route::post('cart/add/(:num)', array('as' => 'cartadd', 'before' => 'csrf', function($productId)
	{
		$cartService = IoC::resolve('cartService');
		$cart = $cartService->loadCart();
		$cart->addPosition($productId);
		$cartService->saveCart($cart);
		return Redirect::to_route('cart');
	}));
Route::post('cart/sub/(:num)', array('as' => 'cartsub', 'before' => 'csrf', function($productId)
	{
		$cartService = IoC::resolve('cartService');
		$cart = $cartService->loadCart();
		$cart->removePosition($productId);
		$cartService->saveCart($cart);
		return Redirect::to_route('cart');
	}));
Route::post('cart/del/(:num)', array('as' => 'cartdel', 'before' => 'csrf', function($productId)
	{
		$cartService = IoC::resolve('cartService');
		$cart = $cartService->loadCart();
		$cart->clearPosition($productId);
		$cartService->saveCart($cart);
		return Redirect::to_route('cart');
	}));

// Account routes
Route::get('account', array('as' => 'account', 'uses' => 'account@index'));

// Information routes
Route::get('information/about', array('as' => 'information_about', 'uses' => 'information@about'));
Route::get('information/contact', array('as' => 'information_contact', 'uses' => 'information@contact'));
Route::get('information/tob', array('as' => 'information_tob', 'uses' => 'information@tob'));
Route::get('information', array('as' => 'information', 'uses' => 'information@about'));


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('image', function($response)
{
	$response->header('Content-Type', 'image/png');
});

Route::filter('before', function()
{
	IoC::resolve('assetManager')->init();
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});