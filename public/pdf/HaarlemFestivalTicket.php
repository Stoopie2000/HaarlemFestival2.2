<?php

$con = mysqli_connect('hfteam6.infhaarlem.nl', 'hfteam6_Group', 'tv5rMk4gL');
mysqli_select_db($con, 'hfteam6_DB');

$query = mysqli_query($con, "SELECT orders_tickets.OrderID, artists.ArtistID, venue.VenueName, date.Date, concerts.StartTime FROM `orders_tickets` 
INNER JOIN plays_at ON plays_at.ConcertID=orders_tickets.ConcertID 
INNER JOIN artists ON artists.ArtistID=plays_at.ArtistID 
INNER JOIN concerts ON concerts.ConcertID=plays_at.ConcertID 
INNER JOIN venue ON venue.VenueID=concerts.VenueID 
INNER JOIN date ON date.DateID=concerts.DateID 
WHERE orders_tickets.OrderID = '".$_GET['OrderID']."'");
$Data = mysqli_fetch_array($query);

require('fpdf.php');
require('qrcode.class.php');

$pdf = new FPDF();
$pdf->AddPage();
            
$pdf->SetFont('Arial','B',16);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(140,15,$Data['Name'], 'LTR', 0);
$pdf->Ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(140,10,$Data['VenueName'], 'LR');

$qrcode = new QRcode($Data['OrderID'], 'L');
$qrcode-> disableBorder ();
$qrcode-> displayFPDF($pdf, 155, 30, 35);

$pdf->Ln();
$pdf->Cell(80,8,$Data['Date'], 'L');
$pdf->Cell(60,8,$Data['Time'], 'R');
$pdf->Ln();
$pdf->Cell(80,11,'Ordernumber: ', 'LB');
$pdf->Cell(60,8,$Data['OrderID'], 'BR');

$pdf->Ln();
$pdf->Ln();
?>