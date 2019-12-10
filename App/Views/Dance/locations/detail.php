<?php

use App\Config;
use App\Models\Venue;

/** @var Venue $venue
 * @var array $concerts
 * @var array $concertsAtLocation
 * @var array $dayTickets
 */
include(dirname(dirname(dirname(__FILE__))) . "/Default/website_head.html")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Dance - <?php echo $venue->Name ?></title>
  <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>/css/Dance/danceStyle.css"
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(dirname(__FILE__))) . "/Default/navigation.html") ?>
<main style="">
    <div class="titleContainerDetail container">
        <div class="row">
            <div class="col-sm-8">
              <h1 style="text-transform: capitalize" >
                  <?php echo($venue->Name); ?></h1>
            </div>
        </div>
    </div>
    <div class="container descriptionContainer">
        <div class="row">
            <div class="col-sm-6">
                <p> <?php echo($venue->Description); ?> </p>
            </div>
            <div class="col-sm-6">
                <img class="img-fluid" src="<?php echo(Config::URLROOT . "img/dance/"); echo($venue->Image)?>">
            </div>
        </div>
    </div>
    <div class="container ticketContainer">
        <h2>Buy Tickets Now!</h2>
        <?php foreach ($concertsAtLocation as $concert) {
    echo("<div class='row ticket'>
            <div class='col-sm-6'>Tickets for $venue->Name $concert->Date $concert->StartTime - $concert->EndTime</div>
            <div class='col-sm-1'>€$concert->Price</div>
            <div class='col-sm-5'>
              <a class='btn btn-light' href='detail.php'>Add To Basket</a>
            </div>
          </div>");
} ?>
    </div>
    <div class="container allAccessContainer">
        <div class='row'>
            <div class='col-sm-6'>
                <h2>All-access passes Haarlem dance</h2>
                <p>A ticket for the whole day</p>
            </div>
        </div>
    <?php foreach ($dayTickets as $dayTicket) {
    if (!isset($dayTicket->Day)) {
         echo"<div class='row'>
                <div class='col-sm-6'>
                    <h2>All-access pass for Friday 27, Saturday 28 and Sunday 29</h2>
                </div>
              </div>
        <div class='row ticket'>
            <div class='col-sm-6'>
                One all-access pass for the entire Haarlem dance
            </div>
            <div class='col-sm-1'>
                $dayTicket->Price
            </div>
            <div class='col-sm-5'>
                <a class='btn btn-light' href='detail.php'>Add To Basket</a>
            </div>
        </div>
        <a>View the entire Haarlem dance schedule</a>"; } else{
        echo("<div class='row ticket'>
            <div class='col-sm-6'>
                All-access pass for $dayTicket->Day
            </div>
            <div class='col-sm-1'>
                $dayTicket->Price
            </div>
            <div class='col-sm-5'>
                <a class='btn btn-light' href='detail.php'>Add To Basket</a>
            </div>
        </div>
            <div class='row schedule'>
                <div class='col-sm-6'>
                  <h2>Schedule $dayTicket->Day</h2>
                  <ul>")?>
            <?php foreach ($concerts as $concert) {

            if ($concert->Date == $dayTicket->Day) {
                $concertArtists = [];
                foreach ($concert->Artists as $artist) {
                    $concertArtists[] = $artist->Name;
                }
                $concertArtistsNames = implode(", ", $concertArtists);

                echo "<li style='list-style-type: none;'>$concert->StartTime - $concert->EndTime $venue->Name: <b>$concertArtistsNames</b></li>";
            }
            }; echo "</ul>
                </div>
            </div>";
    }
}?>

    </div>
</main>
</body>