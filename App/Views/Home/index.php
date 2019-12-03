<?php

use App\Config;

require dirname(__DIR__) . '\header.html'

    // Hieronder kan je je html code kwijt voor de pagina
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/jazz/homepage.css">
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
            <li class="linav"><a class="active" href=><span>HOME</span></a></li>
            <li class="linav"><a href=><span>JAZZ</span></a></li>
            <li class="linav"><a href=><span>DANCE</span></a></li>
            <li class="linav"><a href=><span>FOOD</span></a></li>
        </ul>
    </nav>

    <div class="background">
        <img src="<?php echo Config::URLROOT; ?>/img/jazz/haarlem-spaarne-zomer.jpg" alt="Haarlem Spaarne">
    </div>

    <div class="backgroundText">
        <p class="introductionText">Haarlem Festival is a festival spanning multiple days in the city of Haarlem. With the four different</br>
        events: Jazz, Food, Dance and Historic we show four different sides of Haarlem's rich culture.</br>
        The festival will take place from Thursday 26th of July to Sunday 29th of July.
        </p>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <div class="row">
        <div class="column">
            <img src="<?php echo Config::URLROOT; ?>/img/jazz/jazz-homepage.jpg" alt="Jazz musician">
            <div class="jazz">
                <a class="detailTitle">Jazz</a>
                <p class="detailText">Haarlem Festival has invited some of</br>
                                    the best jazz artists for a very</br>
                                    special event.</br> 
                                    On Thursday, Friday and Saturday</br>
                                    Patronaat will host the jazz event. On</br>
                                    Sunday there will be a free concert</br>
                                    near De Grote Kerk.
                </p>
            </div>
        </div>
        <div class="column">
            <img src="<?php echo Config::URLROOT; ?>/img/jazz/food-homepage.jpg" alt="Food">
            <div class="food">
            <a class="detailTitle">Food</a>
                <p class="detailText">If you are coming to Haarlem for the</br>
                                    festival, you can't miss out on the</br>
                                    great food Haarlem has to offer.</br> 
                                    During the festival, a wide selection of</br>
                                    restaurants are available to get a</br>
                                    taste of what we have to offer.
                </p>
            </div>
        </div>
        <div class="column">
            <img src="<?php echo Config::URLROOT; ?>/img/jazz/dance-homepage.jpg" alt="DJ">
            <div class="dance">
                <a class="detailTitle">Dance</a>
                <p class="detailText">Enjoy a very special three-day event </br>
                                    with music from some of the best </br>
                                    Dutch DJ’s. During this event the city </br> 
                                    center will be transformed into a </br>
                                    haven for dance, trance, house </br>
                                    techno fanatics.
                </p>
            </div>
        </div>
    </div>
</body>

</html>

<?php
    // Hier eindigen we de pagina mee
    require dirname(__DIR__) . '\footer.html'
?>