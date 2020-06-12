<?php


class HaarlemFestivalTicketNew extends \Core\Model
{
    public function makePDF(){
        $con = mysqli_connect('localhost', 'hfteam6_Group', 'tv5rMk4gL');
        mysqli_select_db($con, 'hfteam6_DB');

        $query = mysqli_query($con, "SELECT orders_tickets.OrderID, artists.Name, venue.Name AS Venue, date.Date, concerts.StartTime FROM `orders_tickets` 
INNER JOIN plays_at ON plays_at.ConcertID=orders_tickets.ConcertID 
INNER JOIN artists ON artists.ArtistID=plays_at.ArtistID 
INNER JOIN concerts ON concerts.ConcertID=plays_at.ConcertID 
INNER JOIN venue ON venue.VenueID=concerts.VenueID 
INNER JOIN date ON date.DateID=concerts.DateID 
WHERE orders_tickets.OrderID = '". $orderid ."'");
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
        $pdf->Cell(140,10,$Data['Venue'], 'LR');

        $qrcode = new QRcode($Data['OrderID'], 'L');
        $qrcode-> disableBorder ();
        $qrcode-> displayFPDF($pdf, 155, 15, 35);

        $pdf->Ln();
        $pdf->Cell(15,8,'Date: ', 'L');
        $pdf->Cell(55, 8, $Data['Date']);
        $pdf->Cell(15,8,'Time: ');
        $pdf->Cell(55,8, $Data['StartTime'], 'R');
        $pdf->Ln();
        $pdf->Cell(80,11,'Ordernumber: ', 'LB');
        $pdf->Cell(60,11,$Data['OrderID'], 'BR');

        $pdf->Ln();
        $pdf->Ln();

        $pdf->Output();
    }
}