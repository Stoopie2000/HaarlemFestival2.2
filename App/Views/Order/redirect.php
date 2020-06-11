<?php

/** @var String $paymentStatus */
//echo "<p>Your payment status is '" . htmlspecialchars($paymentStatus) . "'.</p>";

if ($paymentStatus == "paid"){
//    echo "Your tickets have been send to your email address and will arrive shortly!";
//    echo $orderid;
    include "/home/hfteam6/domains/hfteam6.infhaarlem.nl/public_html/pdf/HaarlemFestivalTicket.php";
    
}