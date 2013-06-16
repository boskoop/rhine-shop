<?php namespace Rhine\Actions\Account;

use Laravel\Response;
use Rhine\Services\OrderService;
use Rhine\Services\OrderNotFoundException;
use Rhine\Services\PdfService;
use User;
use Tcpdf;

class AccountGetOrderPdfAction
{

	private $orderService;
	private $pdfService;

	public function __construct(OrderService $orderService,
		PdfService $pdfService)
	{
		$this->orderService = $orderService;
		$this->pdfService = $pdfService;
	}

	/**
	 * @return Response
	 */
	public function execute($orderId, User $user)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		try {
			$order = $this->orderService->loadOrderFor($user, $orderId);
		} catch (OrderNotFoundException $e) {
			return Response::error('404');
		}

		$pdf = $this->pdfService->createInvoice($user, $order);
		$content = $pdf->Output('', 'S');
		
		return Response::make($content, 200, array('content-type'=>'application/pdf'));
	}

}