<?php namespace Tests;

class TestTimer
{

	private $startTime;

	public function __construct()
	{
		$this->startMeasure();
	}

	public function startMeasure()
	{
		$this->startTime = microtime(true);
	}

	public function getTimeTaken()
	{
		$diff = microtime(true) - $this->startTime;
		$sec = intval($diff);
		$micro = $diff - $sec;
		$timeTaken = $sec . str_replace('0.', '.', sprintf('%.3f', $micro));
		return $timeTaken;
	}

}