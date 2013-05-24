<?php

use Rhine\DomainModels\Cart\Impl\CartImpl;
use Rhine\DomainModels\Cart\Impl\CartPositionImpl;

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
		$this->assertTrue($this->cart->isEmpty());

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
		$this->assertFalse($this->cart->isEmpty());
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
		$this->assertTrue($this->cart->isEmpty());
	}

	public function testGetProduct()
	{
		$product = $this->createProductForId(1);
		$this->productRepositoryMock
		->expects($this->once())
		->method('findById')
		->with($this->equalTo(1))
		->will($this->returnValue($product));

		$this->cart->addPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals($product, $positions[0]->getProduct());
		$this->assertEquals($product, $positions[0]->getProduct());
		$this->assertEquals($product, $positions[0]->getProduct());
	}

	public function testGetProductLazy()
	{
		$this->productRepositoryMock
		->expects($this->exactly(2))
		->method('findById')
		->with($this->logicalOr($this->equalTo(1), $this->equalTo(2)))
		->will($this->returnCallback(array($this, 'createProductForId')));

		$this->cart->addPosition(1);
		$positions = $this->cart->getPositions();
		$this->assertEquals(1, $positions[0]->getProduct()->id);

		$this->cart->addPosition(2);
		$positions = $this->cart->getPositions();
		$this->assertEquals(1, $positions[0]->getProduct()->id);
		$this->assertEquals(2, $positions[1]->getProduct()->id);
	}

	public function testGetTotalQuantity()
	{
		$this->assertEquals(0, $this->cart->getTotalQuantity());

		$this->cart->addPosition(1);
		$this->assertEquals(1, $this->cart->getTotalQuantity());

		$this->cart->addPosition(1);
		$this->assertEquals(2, $this->cart->getTotalQuantity());

		$this->cart->addPosition(2);
		$this->cart->addPosition(2);
		$this->assertEquals(4, $this->cart->getTotalQuantity());

		$this->cart->removePosition(1);
		$this->assertEquals(3, $this->cart->getTotalQuantity());

		$this->cart->clearPosition(2);
		$this->assertEquals(1, $this->cart->getTotalQuantity());

		$this->cart->clear();
		$this->assertEquals(0, $this->cart->getTotalQuantity());
	}

	public function testGetPrice()
	{
		$this->assertEquals(0, $this->cart->getTotalPrice());

		$this->productRepositoryMock
		->expects($this->exactly(2))
		->method('findById')
		->with($this->logicalOr($this->equalTo(1), $this->equalTo(2)))
		->will($this->returnCallback(array($this, 'createProductForId')));

		$this->cart->addPosition(1);
		$this->cart->addPosition(2);
		$this->cart->addPosition(2);
		$this->cart->addPosition(2);
		$positions = $this->cart->getPositions();
		$this->assertEquals(100, $positions[0]->getUnitPrice());
		$this->assertEquals(200, $positions[1]->getUnitPrice());
		$this->assertEquals(100, $positions[0]->getTotalPrice());
		$this->assertEquals(600, $positions[1]->getTotalPrice());

		$this->assertEquals(700, $this->cart->getTotalPrice());
	}

	public function createProductForId($id)
	{
		return new Product(array('id' => $id,
			'price' => (100 * $id)));
	}

}