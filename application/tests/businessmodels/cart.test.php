<?php

use Rhine\BusinessModels\Impl\CartImpl;
use Rhine\BusinessModels\Impl\CartPositionImpl;

class CartBusinessModelTest extends Tests\UnitTestCase
{

	private $cart;
	private $productRepositoryMock;

	protected function setUpInternal()
	{
		$this->productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');

		$this->cart = new CartImpl($this->productRepositoryMock);
	}

	public function testEmpty()
	{
		$this->assertTrue($this->cart->isEmpty());

		$this->cart->addPosition(1);
		$this->assertFalse($this->cart->isEmpty());

		$this->cart->removePosition(1);
		$this->assertTrue($this->cart->isEmpty());
	}

	public function testGetPositions()
	{
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);

		$positions = $this->cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(1, $positions[0]->getProductId());

		$this->cart->removePosition(1);

		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));
	}

	public function testAddPosition()
	{
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(1, $positions[0]->getQuantity());

		$this->cart->addPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(2, $positions[0]->getQuantity());

		$this->cart->removePosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(1, $positions[0]->getQuantity());
	}

	public function testRemovePosition()
	{
		$this->assertFalse($this->cart->removePosition(1));
		$this->cart->addPosition(1);
		$this->assertTrue($this->cart->removePosition(1));
		$this->assertFalse($this->cart->removePosition(1));
	}

	public function testClearPosition()
	{
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->clearPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$this->cart->clearPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$this->cart->addPosition(1);
		$this->cart->addPosition(1);
		$this->cart->addPosition(1);
		$this->cart->clearPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$this->cart->addPosition(2);
		$this->cart->addPosition(3);
		$this->cart->addPosition(3);
		$this->cart->addPosition(4);
		$this->cart->addPosition(4);
		$this->cart->addPosition(4);
		$this->cart->clearPosition(1);
		$this->cart->clearPosition(3);
		$positions = $this->cart->getPositions();
		$this->assertEquals(2, sizeof($positions));
	}

	public function testClear()
	{
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));
		
		$this->cart->clear();
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$this->cart->clear();
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$this->cart->addPosition(1);
		$this->cart->addPosition(1);
		$this->cart->addPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->cart->clear();
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));

		$this->cart->addPosition(1);
		$this->cart->addPosition(2);
		$this->cart->addPosition(3);
		$this->cart->addPosition(3);
		$this->cart->addPosition(4);
		$this->cart->addPosition(4);
		$this->cart->addPosition(4);
		$positions = $this->cart->getPositions();
		$this->assertEquals(4, sizeof($positions));
		$this->cart->clear();
		$positions = $this->cart->getPositions();
		$this->assertEquals(0, sizeof($positions));
	}

}