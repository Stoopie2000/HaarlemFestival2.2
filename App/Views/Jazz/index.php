<?php 
    use App\Config;

    /*require dirname(__DIR__) . '\header.html'*/

    if (!isset($_SESSION)) {
    session_start();
    }
      
    $_SESSION['return_to'] = $_SERVER['REDIRECT_URL'];
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/jazz/jazzstyle.css">
    <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>/css/Default/Navigation.css">
    <script src="https://kit.fontawesome.com/1ccd03e13f.js" crossorigin="anonymous"></script>
    <title>Haarlem Festival Homepage</title>
</head>

<body id="jazzPage" class="">
    <div class="logo">
        <img src="<?php echo Config::URLROOT; ?>/img/jazz/haarlem-logo-png-transparent.png" alt="Logo Haarlem" width="180" height="150">   
    </div>

    <?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html")?>

    <div class="background">
        <img src="<?php echo Config::URLROOT; ?>/img/jazz/gumbokings.jpg" alt="Gumbo Kings">
    </div>

    <div class="backgroundText">
        <p class="jazzText">Haarlem Festival has invited some of the best jazz artists for a very special event. 
        On Thursday, Friday and Saturday Patronaat will host the jazz event. On Sunday there will be a free concert on near De Grote Kerk
        </p>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <div class="tab">
            <?php echo("<button class=tabLinks onclick=window.location.href='" . Config::URLROOT . "/jazz'><a>Line up</a></button>");?>
            <button class="active"><a>Tickets</a></button>
    </div>

    <div class="tabDays">
    <?php
        foreach($dates as $date){
            
            $dayName = date_format($date->Date, "l");

            if($dayName == $day){
                echo("<button class='active'><a>$day</a></button>");
            }
            else if($dayName != "Sunday"){
                echo("<button class=tabLinks onclick=window.location.href='" . Config::URLROOT . "/jazz/$dayName'><a>$dayName</a></button>");
            }
        }
            
    ?>
    </div>

    <div class="ticketsMenu">

<a class="allAccessHead">All Access Tickets</a>
<div class = "allAccess">
        <?php
                /** @var array $allAccessJazz */
                foreach ($allAccessJazz as $allAccessJazzTicket) 
                {
                    $ticketPrice = number_format($allAccessJazzTicket->Price, 2);

                    echo ("<ul><li><a> $allAccessJazzTicket->Name </a><li><a class=priceAllAccess>€$ticketPrice</a></li><li class=quantity>
                    <a class=Add href=../order/addItems?productType=dayTicket&productID=$allAccessJazzTicket->DayTicketID&quantity=1><i class='fas fa-cart-plus'></i></a>
                    </li></ul>");
                }
        ?>
    
</div>

<div class="dashedLine"></div>

<a class=dayTicketsHead>Tickets <?php echo $day;?></a>

<div class = "dayTickets">
    
    <?php 
        /** @var array $jazzArtists */
        foreach ($jazzArtists as $jazzArtist)
        {
            $numberOfTickets = $jazzArtist->NumberOfTickets;
            $ticketPrice = number_format($jazzArtist->Price, 2);

            if($numberOfTickets <= 0){
                $ticketPrice = 'Sold Out';
            }
            
            echo ("<ul><li><a> $jazzArtist->Name </a><li><a class=hall>$jazzArtist->Hall</a></li><li><a class=priceDay>€$ticketPrice</a></li><li class=quantity>
            <a class=Add href=../order/addItems?productType=concert&productID=$jazzArtist->ConcertID&quantity=1><i class='fas fa-cart-plus'></i></a>
            </li></ul>");
            
        }
    ?>
</div>  

</body>

<?php
    // Hier eindigen we de pagina mee
    require dirname(__DIR__) . '\footer.html'
?>