<?php

/** @var String $paymentStatus */
echo "<p>Your payment status is '" . htmlspecialchars($paymentStatus) . "'.</p>";

if ($paymentStatus == "paid"){
    echo "Your tickets have been send to your email address and will arrive shortly!";

    
}