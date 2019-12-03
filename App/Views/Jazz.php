<?php 

use App\Config;


    require dirname(__DIR__) . '\header.html'

    

    // Hieronder kan je je html code kwijt voor de pagina
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/jazz/jazzstyle.css">
    <title>Haarlem Festival Homepage</title>
</head>

<body>
    <div class="logo">
            <img src="<?php echo Config::URLROOT; ?>/img/jazz/haarlem-logo-png-transparent.png" alt="Logo Haarlem" width="180" height="150">
    </div>

    <div class="topleft"></div>
    <div class="topbar">
        <ul class="ultop"> 
            <li class="top"><a href="login"><span>Login</span></a></li>
            <li class="top"><a href="cart"><span>Cart</span></a></li>
            <div class="search-container">
                
                   <input type="text" placeholder="Search.." name="search">
                
            </div>
        </ul>
    </div>

    <div class="topright"></div>
    
    <nav class ="navbar">
        <ul class="ulnav">
            <li class="linav"><a href=><span>HOME</span></a></li>
            <li class="linav"><a class="active" href=><span>JAZZ</span></a></li>
            <li class="linav"><a href=><span>DANCE</span></a></li>
            <li class="linav"><a href=><span>FOOD</span></a></li>
        </ul>
    </nav>

    <div class="background">
        <img src="<?php echo Config::URLROOT; ?>/img/jazz/gumbokings.jpg" alt="Gumbo Kings">
    </div>

    <div class="backgroundText">
        <p class="introductionText">Haarlem Festival is a festival spanning multiple days in the city of Haarlem. With the four different</br>
        events: Jazz, Food, Dance and Historic we show four different sides of Haarlem's rich culture.</br>
        The festival will take place from Thursday 26th of July to Sunday 29th of July.
        </p>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <div class="tab">
            <button class="tabLinks"><a>Line Up</a></button>
            <button class="active"><a>Tickets</a></button>
    </div>

    <div class="ticketsMenu"></div>

<?php
    // Hier eindigen we de pagina mee
    require dirname(__DIR__) . '\footer.html'
?>