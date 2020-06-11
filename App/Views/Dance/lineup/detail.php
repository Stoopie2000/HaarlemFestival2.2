<?php

use App\Config;
use App\Models\Artist;

include(dirname(dirname(dirname(__FILE__))) . "/Default/website_head.html");
/** @var Artist $artist
 * @var array $concertsArtistPlaysAt
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
    <title>Haarlem Dance - <?php echo $artist->Name ?></title>
    <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>/css/Dance/danceStyle.css">
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(dirname(__FILE__))) . "/Default/navigation_new.php") ?>

<main>
    <div class="titleContainerDetail container">
        <div class="row">
            <div class="col-sm-12">
                <h1 style="text-transform: capitalize">
                    <?php echo($artist->Name); ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="container descriptionContainer">
        <div class="row">
            <div class="col-sm-6">
                <img class="img-fluid" src="<?php echo(Config::URLROOT . "/img/dance/"); echo($artist->Image)?>">
            </div>
            <div class="col-sm-6">
                <p><?php echo($artist->Description); ?></p>
            </div>
        </div>
    </div>
    <div class="container schedule&TicketsContainer">
        <div class="row">
            <div class="col-sm-6">
                <?php foreach($concertsArtistPlaysAt as $valueConcert){
                    $venue = $valueConcert->Venue;
                    $concertArtists = [];
                    foreach ($valueConcert->Artists as $valueArtist) {
                        $concertArtists[] = $valueArtist->Name;
                    }
                    $concertArtistsNames = implode(", ", $concertArtists);

                    echo "<h3>" . date_format($valueConcert->Date, 'l d F') . "</h3>
                          " . date_format($valueConcert->StartTime, 'H:i') . " $venue->Name: <b>$concertArtistsNames</b>
                                                        ";
                } ?>
            </div>
            <div class="col-sm-6">
                <div class="container ticketContainer">
                    <h2>Buy Tickets Now!</h2>
                    <?php foreach ($concertsArtistPlaysAt as $valueConcert) {
                        $venue = $valueConcert->Venue;
                        echo("<div class='row ticket'>
            <div class='col-sm-6'>Tickets for $artist->Name at $venue->Name " . date_format($valueConcert->Date, 'l d F') . " " . date_format($valueConcert->StartTime, 'H:i') . " - " . date_format($valueConcert->EndTime, 'H:i') . "</div>
            <div class='col-sm-1'>€$valueConcert->Price</div>
            <div class='col-sm-5 btn-container'>");
                            if (isset($_SESSION['basket'])){
                              $matchedConcert = false;
                              foreach ($_SESSION['basket']->items as $basketItem){
                                if ($basketItem->Item == $valueConcert){
                                  $matchedConcert = $valueConcert;
                                }
                              }
                              if (!$matchedConcert){
                                echo "<a class='btn btn-light' href='/order/addItems?productType=concert&productID=$valueConcert->ConcertID&quantity=1'>Add To Basket</a>
            </div>
            </div>";
}else{
                                echo "<a class='btn btn-light' href='/order/basket'>View Basket</a>
            </div>
            </div>";
                              }
}else{
                              echo "<a class='btn btn-light' href='/order/addItems?productType=concert&productID=$valueConcert->ConcertID&quantity=1'>Add To Basket</a>
            </div>
            </div>";}
                                                          }?>
                </div>
            </div>
        </div>
    </div>
</main>
