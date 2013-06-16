<?php namespace Rhine\Services\Impl;

use Tcpdf;

/**
 * Based on: http://www.web-development-blog.com/archives/create-pdf-documents-online-with-tcpdf/
 */
class RhinePdf extends Tcpdf
{

	public function Header()
	{
		$this->CreateTextBox('Rhine Shop', 120, 10, 75, 20, 20, 'B');
		$this->CreateTextBox('Rhine AG', 120, 22, 75, 10, 10);
		$this->CreateTextBox('742 Evergreen Terrace', 120, 27, 75, 10, 10);
		$this->CreateTextBox('Springfield, USA', 120, 32, 75, 10, 10);
	}

	public function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Helvetica', 'I', 8);
		$this->Cell(0, 10, __('rhine/account.pdf_thankyou'), 0, false, 'C');
	}

	public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, 
		$fontsize = 10, $fontstyle = '', $align = 'L')
	{
		$this->SetXY($x+20, $y); // 20 = margin left
		$this->SetFont('Helvetica', $fontstyle, $fontsize);
		$this->Cell($width, $height, $textval, 0, false, $align);
	}

}