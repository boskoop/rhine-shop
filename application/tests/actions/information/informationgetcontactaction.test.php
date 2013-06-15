<?php

use Rhine\Actions\Information\InformationGetContactAction;

/**
 * @group unit
 */
class InformationGetContactActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new InformationGetContactAction();
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$response = $this->action->execute();

		$this->assertResponseViewNameIs('information.contact', $response);
	}

}