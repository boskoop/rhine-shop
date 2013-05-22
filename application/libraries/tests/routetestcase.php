<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Laravel\CLI\Command;
use Laravel\Session;
use Laravel\Cookie;
use Laravel\Config;

abstract class RouteTestCase extends PHPUnit_Framework_TestCase {

	private $timeStart;

	private $tempSessionDriver;

	protected final function setUp()
	{
		$this->timeStart = microtime(true);
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

		$diff = microtime(true) - $this->timeStart;
		$sec = intval($diff);
		$micro = $diff - $sec;
		$timeTaken = $sec . str_replace('0.', '.', sprintf('%.3f', $micro));
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
	protected function httpGet($route)
	{
		return $this->callHttp('GET', $route);
	}

	/*
	 * Simulates a POST request to the router.
	 */
	protected function httpPost($route)
	{
		return $this->callHttp('POST', $route);
	}

	private function callHttp($method, $route)
	{
		echo "\nRouteTestCase: calling HTTP ".$method." '".$route."'";

		$request = \Router::route($method, $route);
		\Request::setMethod($method);

		$response = $request->call();
		$foundation = $response->foundation;
		echo "\nRouteTestCase: response HTTP/".$foundation->getProtocolVersion()." ".$foundation->getStatusCode()."\n";
		return $response;
	}

}