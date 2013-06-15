<?php namespace Rhine\DomainModels\Order;

/**
 * A business object for an order item.
 */
interface OrderItemBo
{

	/**
	 * @return string the name of the product
	 */
	function getProductName();

	/**
	 * @return string the name of the category
	 */
	function getCategoryName();

	/**
	 * Returns the quantity of this item.
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
	 * Returns the price of this item (quantity * price).
	 * 
	 * @return int price in minor currency unit.
	 */
	function getTotalPrice();

}