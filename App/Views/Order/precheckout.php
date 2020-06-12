<?php
include(dirname(dirname(__FILE__)) . "/Default/website_head.html");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Haarlem Festival shopping basket</title>
  <link rel="stylesheet" href="/css/Order/basket.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body id="precheckoutPage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php") ?>
  <main class="mt-3">
    <div class="food_container">
      <div class="row">
        <div class="col-12">
          <div class="basket">
            <h1>Order overzicht</h1>
          </div>
        </div>
        <div class="col-12">
          <div class="">
            <div class="basketContainer food_container">
                <?php
                $priceTotal = 0;
                foreach($_SESSION['basket']->items as $basketItem){
                    $priceTotal += $basketItem->Price * $basketItem->Quantity;
                    echo ("
            <div class=\"row\">
              <div class=\"col-sm-6\">
              <p>$basketItem->Description</p>
              <p class='small mt-n3'>");
                    if(isset($basketItem->Extra)){echo $basketItem->Extra;};
                    echo ("
              </p>
              </div>
              <div class=\"col-sm-4\">
                <p>Aantal: $basketItem->Quantity</p>
              <div class='dropdown'>
              </div>
              </div>
              <div class=\"col-sm-2 priceContainer\">
              <b class='price' id='price$basketItem->ItemID'> € " . $basketItem->Price * $basketItem->Quantity . "</b>
              </div>
            </div>");
                }
                ?>

            </div>
          </div>
        </div>
      </div>
      <div class="priceTotalContainer food_container">
        <div class="row">
          <div class="col-sm-6">

          </div>
          <div class="col-sm-4">
            <p>Total</p>
          </div>
          <div id="priceTotal" class="col-sm-2 priceContainer">
              <?php
              echo "€ $priceTotal";
              ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-2 offset-10">
          <a class="btn btn-primary" href="/order/checkout">To Checkout</a>
        </div>
      </div>
    </div>
  </main>
</body>