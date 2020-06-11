<?php

use App\Config;

//require dirname(__DIR__) . '/header.html'

    // Hieronder kan je je html code kwijt voor de pagina
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/Home/homepage.css">
    <title>Haarlem Festival Homepage</title>

    <?php include(dirname(dirname(__FILE__)) . "/Default/website_head.html");?>
</head>

<body id="homePage">
    <?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php")?>

    <div class="background">
        <img src="<?php echo Config::URLROOT; ?>/img/home/haarlem-spaarne-zomer.jpg" alt="Haarlem Spaarne">
    </div>

    <div class="backgroundText">
        <p class="introductionText">Haarlem Festival is a festival spanning multiple days in the city of Haarlem. With the four different
        events: Jazz, Food, Dance and Historic we show four different sides of Haarlem's rich culture.
        The festival will take place from Thursday 26th of July to Sunday 29th of July.
        </p>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <h1 class="eventHeader">The events</h1>
  <div class="container-fluid">
    <div class="custom-row row">
        <?php

        foreach($events as $event)
        {
            echo ("<a class='linkStyling' href='/$event->Name' style='text-decoration:none; height: 350px;'><div class='column'>
              <img class='img-fluid' src=" . Config::URLROOT . "/img/home/$event->Image alt=Jazz musician>
                  <div class=textBox; style='background-color:$event->Color';>
                      <h2 class='detailTitle'>$event->Name</h2>
                      <p class='detailText'>$event->Description</br></br><img src='img/home/linkarrow.png' style='float:right;'></p>
                  </div>
              </div></a>");
        }
        ?>
    </div>
  </div>
</body>

</html>

<?php
    // Hier eindigen we de pagina mee
    require dirname(__DIR__) . '/footer.html'
?>