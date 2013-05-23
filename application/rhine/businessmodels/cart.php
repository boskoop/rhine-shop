<?php namespace Rhine\BusinessModels;

interface Cart
{

	/**
	 * @return boolean true if the cart contains elements, false otherwise
	 */
	function isEmpty();

	/**
	 * Returns an array of the positions.
	 * 
	 * @return CartPosition[] or an empty array if empty
	 */
	function getPositions();

	/**
	 * Returns to total quantity of items the cart.
	 * 
	 * @return int
	 */
	function getTotalQuantity();

	/**
	 * Returns to total price of the cart.
	 * 
	 * @return int the price in minor currency unit
	 */
	function getTotalPrice();

	/**
	 * Adds a position to the cart.
	 * 
	 * @return void
	 */
	function addPosition($productId);

	/**
	 * Removes a position from the cart.
	 * 
	 * @return boolean true, if an actual element was removed, false otherwise 
	 *                 (this means that the cart does not contain any product 
	 *                 with this id)
	 */
	function removePosition($productId);

	/**
	 * Clears the position from the cart.
	 * 
	 * @return void
	 */
	function clearPosition($productId);

	/**
	 * Clears the cart.
	 * 
	 * @return void
	 */
	function clear();

}
