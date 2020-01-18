<?php
include(dirname(dirname(__FILE__)) . "/Default/website_head.html");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Haarlem Festival shopping basket</title>
  <link rel="stylesheet" href="/css/Order/basket.css">
  <link rel="stylesheet" href="/css/Default/Navigation.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body id="precheckoutPage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html") ?>
  <main style="margin-top: 200px">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <div class="basket">

          </div>
        </div>
        <div class="col-9">
          <div class="">

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
          <a class="btn btn-primary" href="/order/checkout">To Checkout</a>
        </div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
          <form method="post" action="/order/webhook">
            <input name="id"/>
          <button class="btn btn-primary">Fake mollie webhook</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>