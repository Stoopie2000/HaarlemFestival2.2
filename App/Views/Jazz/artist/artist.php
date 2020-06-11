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
    <title>Haarlem Festival Homepage</title>
</head>

<body>
    <div class="logo">
        <img src="<?php echo Config::URLROOT; ?>/img/jazz/haarlem-logo-png-transparent.png" alt="Logo Haarlem" width="180" height="150">   
    </div>

    <?php include(dirname(dirname(dirname(__FILE__))) . "/Default/navigation.html") ?>

    <div class="background">
        <img src="<?php echo Config::URLROOT . "/img/jazz/" .$Event->Image?>" alt="Gumbo Kings">
    </div>

    <div class="backgroundText">
        <p class="jazzText"><?php $Event->Description ?></p>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <div class="tab">
            
            <?php
            echo("<button class=tabLinks onclick=window.location.href='" . Config::URLROOT . "/jazz'><a>Line Up</a></button>");
            echo("<button class=tabLinks onclick=window.location.href='" . Config::URLROOT . "/jazz/Thursday'><a>Tickets</a></button>");?>
    </div>

    <div class="artistContainer">
     <a class="backButton"href="/jazz"><img src="/img/jazz/artist/close-button.png"></a>
        <div class="artistRow">
            <?php  echo ("<div class='artistColumn'><h3>$artist->Name</h3><p class='description'>$artist->Description</p></div>");?>
            <?php  echo ("<div class='artistColumn'><img class='img-fluid' src=" . Config::URLROOT . "/img/jazz/artist/$artist->Image style='height:400px; width:600px; overflow:hidden;'></div>");?>
        </div>
   
        <div class="artistRow">
            <?php 
                if($artist->Video == NULL){
                    echo ("<div class='artistColumnEmpty'><a>No video available</a></div>");
                }
                else{
                    echo ("<div class='artistColumn'><iframe width='600' height='400'
                    src='https://www.youtube.com/embed/$artist->Video'>
                    </iframe></div>");
                }
            ?>

            <div class="artistTimes"><h4>Times</h4>
                <?php 
                    $day;
                    $firstValue = reset($concertsArtist);

                    foreach($concertsArtist as $concert){
                        foreach($dates as $date){

                            if($firstValue->DateID == $date->DateID){
                                $day = date_format($date->Date, "l");
                            }

                            if($date->DateID == $concert->DateID){
                                $dayName = date_format($date->Date, "l");
                                $startTime = $concert->StartTime;
                                $endTime = $concert->EndTime;

                                $startTime = $startTime->format("H:i");
                                $endTime = $endTime->format("H:i");

                                echo("<div class='concert'><a class='dayNameArtist'>$dayName:<a class='concertTime'>$startTime - $endTime</a></div>");
                            }
                        }
                    }
                    echo("<button class='ticketsButton' onclick=window.location.href='" . Config::URLROOT . "/jazz/$day'><a>Go to tickets</a></button>");
                ?>
            </div>
        </div>
    </div>

    </body>    

  