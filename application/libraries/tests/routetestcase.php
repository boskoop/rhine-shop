<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Laravel\CLI\Command;
use Laravel\Session;
use Laravel\Cookie;
use Laravel\Config;
use Laravel\Input;
use Laravel\Request;
use Laravel\Routing\Router;

abstract class RouteTestCase extends PHPUnit_Framework_TestCase {

	private $timer;

	private $tempSessionDriver;

	protected final function setUp()
	{
		$this->timer = new TestTimer();
		echo "\n\n================================================================================";
		echo "\nRouteTestCase: running ".get_class($this)."->".$this->getName()."()";

		PersistenceTestHelper::cleanDatabase();

		// Initialize the session (session is retrieved via cookie)
		$tempSessionDriver = Config::get('session.driver');
		Config::set('session.driver', 'database');
		Session::load();

		// Seed test-data
		Command::run(array('seed_data'));
		echo "\n";

		$this->setUpInternal();
	}

	protected final function tearDown()
	{
		// Reset session driver
		Config::set('session.driver', $this->tempSessionDriver);

		$this->tearDownInternal();

		$timeTaken = $this->timer->getTimeTaken();
		echo "\nRouteTestCase: completed ".get_class($this)."->".$this->getName()."()";
		echo "\nRouteTestCase: took ".$timeTaken." seconds";
		echo "\n================================================================================\n";
	}

	/**
	 * Template method, is called on PHPUnit setUp().
	 *
	 * @return void
	 */
	protected function setUpInternal() { }

	/**
	 * Template method, is called on PHPUnit tearDown().
	 *
	 * @return void
	 */
	protected function tearDownInternal() { }

	/*
	 * Simulates a GET request to the router.
	 */
	protected function httpGet($route, $input = array())
	{
		return $this->callHttp('GET', $route, $input);
	}

	/*
	 * Simulates a POST request to the router.
	 */
	protected function httpPost($route, $input = array())
	{
		return $this->callHttp('POST', $route, $input);
	}

	private function callHttp($method, $route, $input)
	{
		$timer = new TestTimer();

		echo "\nRouteTestCase: calling HTTP ".$method." '".$route."'";

		$request = Router::route($method, $route);
		Request::setMethod($method);

		$response = $request->call();
		$foundation = $response->foundation;
		echo "\nRouteTestCase: response HTTP/".$foundation->getProtocolVersion()." ".$foundation->getStatusCode();
		echo "\nRouteTestCase: HTTP call took ".$timer->getTimeTaken()." seconds\n";
		return $response;
	}

}