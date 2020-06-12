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
  <link rel="stylesheet" href="/css/Order/basket.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body id="basketPage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php") ?>
<main style="margin-top: 200px">
  <?php
  if(!isset($_SESSION))
  {session_start();}
  if (empty($_SESSION['basket']) || empty($_SESSION['basket']->items)){ ?>
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
              <div class='dropdown'>
                <select id='$basketItem->ItemID' onchange=\"quantity_changed('$basketItem->ItemID', '$basketItem->Price')\">");
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
              <div class=\"col-sm-2 priceContainer\">
                <b class='price' id='price$basketItem->ItemID'> € " . $basketItem->Price * $basketItem->Quantity . "</b>
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
            <div id="priceTotal" class="col-sm-2 priceContainer">
                <?php
                echo "€ $priceTotal";
                ?>
            </div>
        </div>
    </div>
    <div class="checkoutButtonContainer container">
      <div class="row">
        <div class="col-sm-10"></div>
        <div class="col-sm-2">
          <a href="/order/precheckout" class="btn btn-primary .btn-block">To order overview</a>
          <div class="small">
            You won't have to pay yet.
          </div>
        </div>
      </div>
    </div>
</main>
</body>

<?php } ?>

<script>
    function quantity_changed(item_id, item_price) {
        var newQuantity = document.getElementById(item_id).value;
        save_to_db(item_id, newQuantity, item_price);
    }

    function save_to_db(item_id, new_quantity, item_price) {
        var priceId = "#price" + item_id;
        $.ajax({
            url : "/order/updateQuantity",
            data : {item_id: item_id, new_quantity: new_quantity},
            type : 'post',
            success : function(response) {
              update_screen(response, new_quantity, item_price, priceId)
            }
        });
    }

    function update_screen(response, new_quantity, item_price, priceId){
        var totalItemPrice = new_quantity * item_price;
        $(priceId).text("€ " + totalItemPrice);
        var price_total = 0;

        $(".price").each(function(){
            var item_price = $(this).text().replace('€', '');
            price_total = parseInt(price_total) + parseInt(item_price);
        });
        $("#priceTotal").text("€ " + parseInt(price_total))
    }
</script>
