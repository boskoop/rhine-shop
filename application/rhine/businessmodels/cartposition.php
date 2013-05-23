<?php namespace Rhine\BusinessModels;

interface CartPosition
{

	/**
	 * Returns the product id of the cart position.
	 * 
	 * @return int id of the Product
	 */
	function getProductId();

	/**
	 * Loads the Product from the database.
	 * 
	 * @return Product
	 */
	function getProduct();

	/**
	 * Returns the quantity of this position.
	 * 
	 * @return int
	 */
	function getQuantity();

	/**
	 * Returns the price of this product.
	 * 
	 * @return int price in minor currency unit.
	 */
	function getUnitPrice();

	/**
	 * Returns the price of this position (quantity * price).
	 * 
	 * @return int price in minor currency unit.
	 */
	function getTotalPrice();

}
