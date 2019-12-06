<?php

include(dirname(dirname(dirname(__FILE__))) . "/Default/website_head.html")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Dance</title>
</head>
<body id="dancePage" class="">
<main style="">
    <div class="titleContainer container">
        <div class="row">
            <div class="col-sm-3">
                <h1 style="text-transform: capitalize" ><?php echo($venue->Name); ?></h1>
            </div>
        </div>
    </div>
    <div class="container descriptionContainer">
        <div class="row">
            <div class="col-sm-6">
                <p> <?php echo($venue->Description); ?> </p>
            </div>
            <div class="col-sm-6">
                <img src="<?php echo($venue->Image) ?>">
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Buy Tickets Now!</h2>
        <div class="row">
        <?php  foreach($concerts as $concert){ echo("<div class='col-sm-6'>Tickets for $venue->Name $concert->Date</div><div class='col-sm-3'>$concert->Price</div><div class='col-sm-3'><a href='detail.php'>Add To Basket</a></div>"); }  ?>
    </div>
</main>
</body>