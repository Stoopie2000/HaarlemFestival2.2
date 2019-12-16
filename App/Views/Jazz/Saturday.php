<?php 
    use App\Config;

    /*require dirname(__DIR__) . '\header.html'*/

    
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/jazz/jazzstyle.css">
    <script src="https://kit.fontawesome.com/1ccd03e13f.js" crossorigin="anonymous"></script>
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
        <p class="jazzText">Haarlem Festival is a festival spanning multiple days in the city of Haarlem. With the four different
        events: Jazz, Food, Dance and Historic we show four different sides of Haarlem's rich culture.
        The festival will take place from Thursday 26th of July to Sunday 29th of July.
        </p>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <div class="tab">
            <button class="tabLinks"><a>Line Up</a></button>
            <button class="active"><a>Tickets</a></button>
    </div>

    <div class="tabDays">
            <button class="tabLinks"><a>Thursday</a></button>
            <button class="tabLinks"><a>Friday</a></button>
            <button class="active"><a>Saturday</a></button>
    </div>

    <div class="ticketsMenu">

<a class="allAccessHead">All Access Tickets</a>
<div class = "allAccess">
        <?php
                /** @var array $allAccessJazz */
                foreach ($allAccessJazz as $allAccessJazzTicket) 
                {
                    echo ("<ul><li><a> $allAccessJazzTicket->Name </a><li><a class=priceAllAccess>€$allAccessJazzTicket->Price,00</a></li><li class=quantity>
                    <i class='fas fa-minus-circle fa-lg'></i>
                    <input class=qty type=number value=0 />
                    <i class='fas fa-plus-circle fa-lg'></i>
                    </li></ul>");
                }
        ?>
    
</div>

<div class="dashedLine"></div>

<a class=dayTicketsHead>Tickets Friday</a>

<div class = "dayTickets">
    
    <?php 
        /** @var array $jazzArtists */
        foreach ($jazzArtists as $jazzArtist)
        {
            if($jazzArtist->DateID == 3)
            { 
                echo ("<ul><li><a> $jazzArtist->Name </a><li><a class=hall>$jazzArtist->Hall</a></li><li><a class=priceDay>€$jazzArtist->Price,00</a></li><li class=quantity>
                <a class=Add href=/order/addItems?productType=concert&productID=$jazzArtist->ConcertID&quantity=1><i class='fas fa-cart-plus'></i></a>
                </li></ul>");
            }
        }
    ?>
</div>

<?php
    // Hier eindigen we de pagina mee
    require dirname(__DIR__) . '\footer.html'
?>