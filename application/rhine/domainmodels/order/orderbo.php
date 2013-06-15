<?php namespace Rhine\DomainModels\Order;

/**
 * A business object for an order.
 */
interface OrderBo
{

	/**
	 * @return Order the elequent model for the order
	 */
	function getOrderModel();

	/**
	 * @return int the id of the order
	 */
	function getOrderId();

	/**
	 * @return boolean true, if the order is paid, false otherwise
	 */
	function isPaid();

	/**
	 * @return boolean true, if the order is shipped, false otherwise
	 */
	function isShipped();

	/**
	 * Returns to total price of the order.
	 * 
	 * @return int the price in minor currency unit
	 */
	function getTotalPrice();

	/**
	 * @return OrderItemBo[] the items of the order
	 */
	function getItems();

	/**
	 * Marks the order as paid with the current timestamp. This does not save
	 * the model to the database.
	 */
	function payOrder();

	/**
	 * Marks the order as shipped with the current timestamp. This does not
	 * save the model to the database.
	 */
	function shipOrder();

}