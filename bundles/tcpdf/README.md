## TCPDF Bundle for Laravel

## How to install ##

Tcpdf bundle for Laravel, installable via the Artisan CLI:

```php
php artisan bundle:install Tcpdf
```

Or you can manually copy the tcpdf folder from the downloaded package into the bundles folder.

Now you must auto-load the bundle in bundles.php

```php
'tcpdf' => array('auto' => true),
```

## Basic example ##

Here is a basic example on how to use the bundle:

```php
$pdf = new Tcpdf();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
```

## TCPDF by Nicola Asuni ##

TCPDF is a PHP class for generating PDF files on-the-fly without requiring external extensions.

- Homepage:      	http://www.tcpdf.org
- Documentation:	http://www.tcpdf.org/docs.php

Examples are included in the bundle under:
library/examples

On the tcpdf homepage you will find links to the documenation, forums and so on.