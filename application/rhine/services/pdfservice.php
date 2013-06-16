<?php namespace Rhine\Services;

use Rhine\DomainModels\Order\OrderBo;
use User;
use Tcpdf;

interface PdfService
{

	/**
	 * Creates a pdf invoice with tcpdf.
	 * 
	 * @return Tcpdf
	 */
	function createInvoice(User $user, OrderBo $order);

}