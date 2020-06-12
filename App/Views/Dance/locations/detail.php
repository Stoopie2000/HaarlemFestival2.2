<?php

use App\Config;
use App\Models\Venue;

/**
 * @var Venue $venue
 * @var array $concerts
 * @var array $concertsAtLocation
 * @var array $dayTickets
 * @author Bram Bos <brambos27@gmail.com>
 */
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['return_to'] = $_SERVER['REDIRECT_URL'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php  include(dirname(dirname(dirname(__FILE__))) . "/Default/website_head.html"); ?>

  <title>Haarlem Dance - <?php echo $venue->Name ?></title>
  <link rel="stylesheet" href="/css/Dance/danceStyle.css"
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(dirname(__FILE__))) . "/Default/navigation_new.php") ?>
<main style="">
    <div class="titleContainerDetail food_container">
        <div class="row">
            <div class="col-sm-8">
              <h1 style="text-transform: capitalize" >
                  <?php echo($venue->Name); ?></h1>
            </div>
        </div>
    </div>
    <div class="food_container descriptionContainer">
        <div class="row">
            <div class="col-sm-6">
                <p> <?php echo($venue->Description); ?> </p>
            </div>
            <div class="col-sm-6">
                <img class="img-fluid" src="<?php echo(Config::URLROOT . "/img/dance/"); echo($venue->Image)?>">
            </div>
        </div>
    </div>
    <div class="food_container ticketContainer">
        <h2>Buy Tickets Now!</h2>
        <?php foreach ($concertsAtLocation as $concert) {
    echo("<div class='row ticket'>
            <div class='col-sm-6'>Tickets for $venue->Name " . date_format($concert->Date, 'l d F') . " " . date_format($concert->StartTime, 'G:i') . " - " . date_format($concert->EndTime, 'G:i') . "</div>
            <div class='col-sm-1'>€$concert->Price</div>
            <div class='col-sm-5'>
              ");
    if (!isset($_SESSION['basket'])){
        echo "<a class='btn btn-light' href='/order/addItems?productType=concert&productID=$concert->ConcertID&quantity=1'>Add To Basket</a>
            </div>
            </div>";
    }else{
        $matchedConcert = false;
        foreach ($_SESSION['basket']->items as $basketItem){
            if ($basketItem->Item == $concert){
                $matchedConcert = $concert;
            }
        }
        if (!$matchedConcert){
            echo "<a class='btn btn-light' href='/order/addItems?productType=concert&productID=$concert->ConcertID&quantity=1'>Add To Basket</a>
            </div>
            </div>";
        }else{
            echo "<a class='btn btn-light' href='/order/basket'>View Basket</a>
            </div>
            </div>";
        }
    }
} ?>
    </div>
    <div class="food_container allAccessContainer">
        <div class='row'>
            <div class='col-sm-6'>
                <h2>All-access passes Haarlem dance</h2>
                <p>A ticket for the whole day</p>
            </div>
        </div>
    <?php foreach ($dayTickets as $dayTicket) {
        $dayStings = [];
        foreach ($dayTicket->Days as $day){
            $dayStings[] = date_format($day, 'l d F');
        }

      $daysCommaSeparated = implode(', ', $dayStings);

         echo"<div class='row'>
                <div class='col-sm-6'>
                    <h2>All-access pass for $daysCommaSeparated</h2>
                </div>
              </div>
        <div class='row ticket'>
            <div class='col-sm-6'>
                $dayTicket->Name
            </div>
            <div class='col-sm-1'>
                €$dayTicket->Price
            </div>
            <div class='col-sm-5'>";
                    if (!isset($_SESSION['basket'])){
        echo "<a class='btn btn-light' href='/order/addItems?productType=dayTicket&productID=$dayTicket->DayTicketID&quantity=1'>Add To Basket</a>
            </div>
            </div>";
    }else {
            $matchedDayTicket = false;
            foreach ($_SESSION['basket']->items as $basketItem) {
                if ($basketItem->Item == $dayTicket) {
                    $matchedDayTicket = $dayTicket;
                }
            }
            if (!$matchedDayTicket) {
                echo "<a class='btn btn-light' href='/order/addItems?productType=dayTicket&productID=$dayTicket->DayTicketID&quantity=1'>Add To Basket</a>
  </div>
  </div>";
            } else {
                echo "<a class='btn btn-light' href='/order/basket'>View Basket</a>
  </div>
  </div>";
            }
                    }

         if (count($dayTicket->Days) > 1){
           echo "<a href='schedule'>View the entire Haarlem dance schedule</a>"; //TODO Werkende link naar schedule
         }else if(count($dayTicket->Days) == 1){
           echo ("
           <div class='row schedule'>
                <div class='col-sm-6'>
                  <h2>Schedule " . date_format($dayTicket->Days[0], 'l d F') . "</h2>
                  <ul>")?>

            <?php foreach ($concerts as $concert) {
            $concertVenue = $concert->Venue;
            if ($concert->Date == $dayTicket->Days[0]) {
                $concertArtists = [];
                foreach ($concert->Artists as $artist) {
                    $concertArtists[] = $artist->Name;
                }
                $concertArtistsNames = implode(", ", $concertArtists);

                echo "<li style='list-style-type: none;'>" . date_format($concert->StartTime, 'H:i') . " - " . date_format($concert->EndTime, 'H:i') . "  $concertVenue->Name: <b>$concertArtistsNames</b></li>";
            }
            }
             echo "</ul>
                </div>
            </div>";
         }
}?>

    </div>
</main>
</body>