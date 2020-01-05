<?php
require('fpdf.php');
require('qrcode.class.php');



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(75,15,'Event');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(140,15,'TicketName', 'LTR', 0);
$pdf->Ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(80,10,'Location: ', 'L');
$pdf->Cell(60,10,'Price: ', 'R');

$qrcode = new QRcode('OrderItem', 'L');
$qrcode-> disableBorder ();
$qrcode-> displayFPDF($pdf, 155, 30, 35);

$pdf->Ln();
$pdf->Cell(80,8,'Date:', 'L');
$pdf->Cell(60,8,'Time:', 'R');
$pdf->Ln();
$pdf->Cell(140,11,'Ordernumber:', 'LBR');

$pdf->Output();
?>