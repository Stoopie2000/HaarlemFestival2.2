<?php 
    use App\Config;

    if (!isset($_SESSION)) {
    session_start();
    }
      
    $_SESSION['return_to'] = $_SERVER['REDIRECT_URL'];
?>

<html lang="en">
<head>
    <?php include(dirname(dirname(__FILE__)) . "/Default/website_head.html") ?>

  <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/jazz/jazzstyle.css">
    <title>Haarlem Festival Homepage</title>


</head>

<body id="jazzPage" class="">
  <?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php") ?>

    <div class="background">
        <img src="<?php echo Config::URLROOT . "/img/jazz/" . $event->Image?>" alt="Gumbo Kings">
    </div>

    <div class="backgroundText">
        <?php echo ("<p class='jazzText'>$event->Description</p>")?>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <div class="tab">
        <button class="active"><a>Line Up</a></button>
        <?php echo("<button class=tabLinks onclick=window.location.href='" . Config::URLROOT . "/jazz/Thursday'><a>Tickets</a></button>");?>
    </div>

    <div class=dayLineup>
        <?php
            foreach($dates as $date){

                echo("<div class='dayRow'>");
                
                $dayName = date_format($date->Date, "l");
                echo ("<div class='dayName'>$dayName</div><div class='fill'></div>");

                foreach($jazzArtists as $jazzArtist){

                    $startTime = $jazzArtist->StartTime->format("H:i");

                    $replaceCharacters = array(" " => "-", "&" => "and");
                    $changedArtistName = strtolower(str_replace(array_keys($replaceCharacters), array_values($replaceCharacters), $jazzArtist->Name));

                    if($jazzArtist->DateID == $date->DateID){
                        

                        echo ("
                            <div class='dayArtist' id='$jazzArtist->Name'><a href='" . Config::URLROOT . "/jazz/artist/$changedArtistName'>
                                        <img class='img-fluid' src=" . Config::URLROOT . "/img/jazz/jazzLineup/$jazzArtist->Image></a>
                                        <div class='artist'>
                                            <a class='artistName'>$jazzArtist->Name<a class='artistTime'>$startTime</a>
                                        </div><div class='dayFill'>
                            </div></div>
                        ");
                    }
                } 
                echo("</div>");
            }
        ?>
    </div>

    </body>


