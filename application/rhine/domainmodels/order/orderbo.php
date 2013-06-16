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
	 * @return string the date of the order 
	 */
	function getOrderDate();

	/**
	 * @return boolean true, if the order is paid, false otherwise
	 */
	function isPaid();

	/**
	 * @return string the date when the order was paid
	 */
	function getPaymentDate();

	/**
	 * @return boolean true, if the order is shipped, false otherwise
	 */
	function isShipped();

	/**
	 * @return string the date when the order was shipped
	 */
	function getShippedDate();

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
	 * @return int the number of items
	 */
	function getNumberOfItems();

	/**
	 * Marks the order as paid with the current timestamp. This does not save
	 * the model to the database.
	 */
	function payOrder();

	/**
	 * Resets the payment state of the order. This does not save
	 * the model to the database.
	 */
	function resetPayOrder();

	/**
	 * Marks the order as shipped with the current timestamp. This does not
	 * save the model to the database.
	 */
	function shipOrder();

	/**
	 * Resets the shippmend state of the order. This does not
	 * save the model to the database.
	 */
	function resetShipOrder();

}