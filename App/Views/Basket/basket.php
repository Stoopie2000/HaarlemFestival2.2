<?php

use App\Config;

include(dirname(dirname(__FILE__)) . "/Default/website_head.html")
/**
 * @var array $basket
 *
 * @author Bram Bos <brambos27@gmail.com>
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Festival shopping basket</title>
    <link rel="stylesheet" href=""
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html") ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Shopping basket</h1>
            </div>
        </div>
    </div>
    <div class="basketContainer container">
        <?php
        $priceTotal = 0;
        foreach($basket->items as $basketItem){
            $priceTotal += $basketItem->Price;
            echo <<<BASKETITEM
        <div class="row">
            <div class="col-sm-6">
            $basketItem->Description
            </div>
            <div class="col-sm-4">
            <p>
              $basketItem->Quantity
           </p>
           <a href="/order/removeItems?itemID=$basketItem->ItemID">Remove Item</a>
            </div>
            <div class="col-sm-2">
            <b> € $basketItem->Price </b>
            </div>
        </div>
BASKETITEM;
        }
        ?>

    </div>
    <div class="priceTotalContainer container">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-4">
                <p>Total</p>
            </div>
            <div class="col-sm-2">
                <?php
                echo "€ $priceTotal";
                ?>
            </div>
        </div>

    </div>
</main>
</body>