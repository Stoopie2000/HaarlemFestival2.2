<?php

use App\Config;

require dirname(__DIR__) . '/header.html'

    // Hieronder kan je je html code kwijt voor de pagina
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::URLROOT; ?>/css/Home/homepage.css">
    <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>/css/Default/Navigation.css">
  <link rel="stylesheet" href="/css/Default/Navigation.css">
    <title>Haarlem Festival Homepage</title>
</head>

<body id="homePage">
    <div class="logo">
            <img src="<?php echo Config::URLROOT; ?>/img/jazz/haarlem-logo-png-transparent.png" alt="Logo Haarlem" width="180" height="150">
    </div>
    <?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html")?>

    <div class="background">
        <img src="<?php echo Config::URLROOT . "/img/home/" . $home->Image?>">
    </div>

    <div class="backgroundText">
        <?php echo ("<p class='introductionText'>$home->Description</p>")?>
        <a class="arrowDown" href=>&#187;</a>
    </div>

    <h1 class="eventHeader">The events</h1>

    <div class="row">
        <?php

        foreach($events as $event)
        {
            if($event->Name != 'Home')
            {
                echo ("<a class='linkStyling' href='/$event->Name' style='text-decoration:none; height: 350px;'><div class='column'>
                <img class='img-fluid' src=" . Config::URLROOT . "/img/home/$event->Image alt=Jazz musician>
                    <div class=textBox; style='background-color:$event->Color';>
                        <h2 class='detailTitle'>$event->Name</h2>
                        <p class='detailText'>$event->Description</br></br><img src='img/home/linkarrow.png' style='float:right;'></p>
                    </div>
                </div></a>");
            }
        }   
        ?>
    </div>
</body>

</html>

<?php
    // Hier eindigen we de pagina mee
    require dirname(__DIR__) . '/footer.html'
?>