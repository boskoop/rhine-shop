<?php

/**
 * @group unit
 */
class RoleEnumTest extends Tests\UnitTestCase
{

	/**
	 * Tests if the role enum contains admin and user
	 * 
	 * @return void
	 */
	public function testRoleEnum()
	{
		$roles = RoleEnum::all();
		$this->assertContains(RoleEnum::ADMIN, $roles);
		$this->assertContains(RoleEnum::USER, $roles);
		$this->assertEquals(2, sizeof($roles));
	}

	/**
	 * Tests if the role enum contains admin and user values
	 * 
	 * @return void
	 */
	public function testGenderEnumValues()
	{
		$roles = RoleEnum::values();
		$this->assertContains(RoleEnum::ADMIN_VALUE, $roles);
		$this->assertContains(RoleEnum::USER_VALUE, $roles);
		$this->assertEquals(2, sizeof($roles));
	}

	/**
	 * Tests if the role enum correctly maps key to values
	 * 
	 * @return void
	 */
	public function testGenderEnumMapValues()
	{
		$this->assertEquals(RoleEnum::ADMIN_VALUE, RoleEnum::getValue(RoleEnum::ADMIN));
		$this->assertEquals(RoleEnum::USER_VALUE, RoleEnum::getValue(RoleEnum::USER));
	}

}