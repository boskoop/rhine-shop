<?php namespace Rhine\Services\Impl;

use Rhine\Services\PdfService;
use Rhine\DomainModels\Order\OrderBo;
use User;
use Tcpdf;

/**
 * Based on: http://www.web-development-blog.com/archives/create-pdf-documents-online-with-tcpdf/
 */
class PdfServiceImpl implements PdfService
{

	public function createInvoice(User $user, OrderBo $order)
	{
		$pdf = new RhinePdf();

		// set document information
		$pdf->SetCreator('TCPDF');
		$pdf->SetAuthor('Rhine Shop');
		$pdf->SetTitle('Invoice #' . $order->getOrderId());
		$pdf->SetSubject('Invoice');
		$pdf->SetKeywords('Invoice, Rhine shop');

		// add a page
		$pdf->AddPage();

		// add barcode with invoice # and user id
		// define barcode style
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => false,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 8,
			'stretchtext' => 4
			);
		$pdf->write1DBarcode('IN#' . str_pad($order->getOrderId(), 7, '0', STR_PAD_LEFT), 'C39E', '', 10, '', 18, 0.4, $style, 'N');

		// create address box
		$address = $user->address()->first();
		$pdf->CreateTextBox(__('rhine/account.title_'.$address->gender->gender), 0, 55, 80, 10, 10);
		$pdf->CreateTextBox($address->forename . ' ' . $address->surname, 0, 60, 80, 10, 10);
		$pdf->CreateTextBox($address->street1, 0, 65, 80, 10, 10);
		$height = 70;
		if ($address->street2 != null) {
			$pdf->CreateTextBox($address->street2, 0, $height, 80, 10, 10);
			$height += 5;
		}
		$pdf->CreateTextBox($address->zip . ' ' . $address->city, 0, $height, 80, 10, 10);
		$height += 5;
		$pdf->CreateTextBox($address->country, 0, $height, 80, 10, 10);

		// invoice title / number
		$pdf->CreateTextBox(__('rhine/account.pdf_invoice') . ' #' . str_pad($order->getOrderId(), 7, '0', STR_PAD_LEFT), 0, 90, 120, 20, 16);

		// date, order ref
		$pdf->CreateTextBox(__('rhine/account.order_date') . ': ' . date('d.m.Y', strtotime($order->getOrderDate())), 0, 100, 0, 10, 10, '', 'R');
		$pdf->CreateTextBox(__('rhine/account.pdf_customer') . ': #' . str_pad($user->id, 5, '0', STR_PAD_LEFT), 0, 105, 0, 10, 10, '', 'R');

		// list headers
		$pdf->CreateTextBox(__('rhine/account.order_quantity'), 0, 120, 20, 10, 10, 'B', 'C');
		$pdf->CreateTextBox(__('rhine/account.order_item'), 20, 120, 90, 10, 10, 'B');
		$pdf->CreateTextBox(__('rhine/account.order_price'), 110, 120, 30, 10, 10, 'B', 'R');
		$pdf->CreateTextBox(__('rhine/account.order_pricetotal'), 140, 120, 30, 10, 10, 'B', 'R');

		$pdf->Line(20, 129, 195, 129);

		// some example data
		$orders[] = array('quant' => 5, 'descr' => '.com domain registration', 'price' => 9.95);
		$orders[] = array('quant' => 3, 'descr' => '.net domain name renewal', 'price' => 11.95);
		$orders[] = array('quant' => 1, 'descr' => 'SSL certificate 256-Byte encryption', 'price' => 99.95);
		$orders[] = array('quant' => 1, 'descr' => '25GB VPS Hosting, 200GB Bandwidth', 'price' => 19.95);

		$currY = 128;
		foreach ($order->getItems() as $item) {
			$pdf->CreateTextBox($item->getQuantity(), 0, $currY, 20, 10, 10, '', 'C');
			$pdf->CreateTextBox($item->getCategoryName() . ': ' . $item->getProductName(), 20, $currY, 90, 10, 10, '');
			$pdf->CreateTextBox('SFr. ' . number_format($item->getUnitPrice() / 100, 2), 110, $currY, 30, 10, 10, '', 'R');
			$pdf->CreateTextBox('SFr. ' . number_format($item->getTotalPrice() / 100, 2), 140, $currY, 30, 10, 10, '', 'R');
			$currY = $currY+5;
		}
		$pdf->Line(20, $currY+4, 195, $currY+4);

		// output the total row
		$pdf->CreateTextBox(__('rhine/account.order_total'), 20, $currY+5, 135, 10, 10, 'B', 'R');
		$pdf->CreateTextBox(number_format($order->getTotalPrice() / 100, 2), 140, $currY+5, 30, 10, 10, 'B', 'R');

		// some payment instructions or information
		$pdf->setXY(20, $currY+30);
		$pdf->SetFont('Helvetica', '', 10);
		$pdf->MultiCell(175, 10, '<em>'.__('rhine/account.pdf_period').'</em>.<br />
			'.__('rhine/account.pdf_bank').': BS - First Bank of Springfield, IBAN: CH93 0076 2011 6238 5295 7 ', 0, 'L', 0, 1, '', '', true, null, true);

		return $pdf;
	}

}