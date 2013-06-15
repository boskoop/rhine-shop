<?php

/**
 * @group unit
 */
class CountryEnumTest extends Tests\UnitTestCase
{

	/**
	 * Tests if the country enum contains 244 countries with iso alpha-2 code.
	 * 
	 * @return void
	 */
	public function testCountryEnum()
	{
		$countries = CountryEnum::all();
		$this->assertEquals(244, sizeof($countries));
		foreach ($countries as $country) {
			$this->assertNotEquals('rhine/country.'.strtolower($country), Lang::line('rhine/country.'.strtolower($country))->get('en'));
			$this->assertNotEquals('rhine/country.'.strtolower($country), Lang::line('rhine/country.'.strtolower($country))->get('de'));
			$this->assertNotEquals('rhine/country.'.strtolower($country), Lang::line('rhine/country.'.strtolower($country))->get('fr'));
		}
	}

}