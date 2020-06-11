<?php 
    use App\Config;
?>
<header class="" id="">
  <div class="topleft"></div>
  <div class="topbar">
    <ul class="ultop">
      <li class="top"><a href="<?php echo Config::URLROOT; ?>/login/new"><span>Login</span></a></li>
      <li class="top"><a href="<?php echo Config::URLROOT; ?>/order/basket"><span>Basket</span></a></li>
    </ul>
  </div>

  <div class="topright"></div>

  <nav class ="navbar">
    <ul class="ulnav">
      <li class="linav"><a class="homeButton" href="<?php echo Config::URLROOT; ?>/"><span>HOME</span></a></li>
      <li class="linav"><a class="jazzButton" href="<?php echo Config::URLROOT; ?>/jazz"><span>JAZZ</span></a></li>
      <li class="linav"><a class="danceButton" href="<?php echo Config::URLROOT; ?>/dance"><span>DANCE</span></a></li>
      <li class="linav"><a class="foodButton" href="<?php echo Config::URLROOT; ?>/food"><span>FOOD</span></a></li>
    </ul>
  </nav>
</header>