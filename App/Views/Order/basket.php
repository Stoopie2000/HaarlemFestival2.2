<?php

use App\Config;

include(dirname(dirname(__FILE__)) . "/Default/website_head.html");
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['return_to'] = $_SERVER['REDIRECT_URL'];
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
  <link rel="stylesheet" href="/css/Dance/danceStyle.css">
  <link rel="stylesheet" href="/css/Default/Navigation.css">
</head>
<body id="basketPage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html") ?>
<main style="margin-top: 200px">
  <?php if (empty($basket) || empty($basket->items)){ ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Your shopping basket is empty!</h1>
        <a href="/">Return to the home page and order some tickets!</a>
      </div>
    </div>
  </div>
  <?php }else{ ?>

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
            echo "        <div class=\"row\">
            <div class=\"col-sm-6\">
            $basketItem->Description
            </div>
            <div class=\"col-sm-4\">
            <div class='dropdown'>
              <select>
              ";
            for($x = 0; $x < ($basketItem->Quantity + 5); $x++){
                    if ($x == $basketItem->Quantity){
                        echo"<option selected value='$x'>$x</option>";
                    }else{
                        echo"<option value='$x'>$x</option>";
                    }
              }
            echo "
              </select>
            </div>
           <a href=\"/order/removeItems?itemID=$basketItem->ItemID\">Remove Item</a>
            </div>
            <div class=\"col-sm-2\">
            <b> € $basketItem->Price </b>
            </div>
        </div>";
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
<?php }