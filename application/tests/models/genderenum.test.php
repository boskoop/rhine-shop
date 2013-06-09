<?php

class GenderEnumTest extends Tests\UnitTestCase
{

	/**
	 * Tests if the gender enum contains male and female
	 * 
	 * @return void
	 */
	public function testGenderEnum()
	{
		$genders = GenderEnum::all();
		$this->assertContains(GenderEnum::MALE, $genders);
		$this->assertContains(GenderEnum::FEMALE, $genders);
		$this->assertEquals(2, sizeof($genders));
	}

	/**
	 * Tests if the gender enum contains male and female values
	 * 
	 * @return void
	 */
	public function testGenderEnumValues()
	{
		$genders = GenderEnum::values();
		$this->assertContains(GenderEnum::MALE_VALUE, $genders);
		$this->assertContains(GenderEnum::FEMALE_VALUE, $genders);
		$this->assertEquals(2, sizeof($genders));
	}

	/**
	 * Tests if the gender enum correctly maps key to values
	 * 
	 * @return void
	 */
	public function testGenderEnumMapValues()
	{
		$this->assertEquals(GenderEnum::MALE_VALUE, GenderEnum::getValue(GenderEnum::MALE));
		$this->assertEquals(GenderEnum::FEMALE_VALUE, GenderEnum::getValue(GenderEnum::FEMALE));
	}

}