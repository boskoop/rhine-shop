<?php

class GenderEnumTest extends Tests\UnitTestCase
{
	/**
	 * Tests if the gender enum contains male and female
	 * 
	 * @return void
	 */
	public function testGenderEnumValues()
	{
		$genders = GenderEnum::all();
		$this->assertContains(GenderEnum::MALE, $genders);
		$this->assertContains(GenderEnum::FEMALE, $genders);
		$this->assertEquals(2, sizeof($genders));
	}

}