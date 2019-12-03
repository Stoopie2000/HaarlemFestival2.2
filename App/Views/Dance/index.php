<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Dance</title>
    <?php
    use App\Models\Artist;
    use App\Models\Venue;

    include(dirname(dirname(__FILE__)) . "/Default/website_head.html")?>
</head>
<body class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html") ?>
<main class="">
    <div>
        <a>Locations</a>
        <div></div>
            <?php
            /** @var Venue $venues */
            foreach ($venues as $venue) {
                echo ("<li style='list-style-type: none;'><a href='venue/$venue->Name'> $venue->Name </a></li>");
            }
        ?>
    </div>
    <div>
        <a>Line Up</a>
        <div></div>
        <?php
            /** @var Artist $artists */
            foreach ($artists as $artist){
                echo ("<li style='list-style-type: none;'><a href='venue/$artist->Name'> $artist->Name </a></li>");
            }
        ?>
    </div>
</main>
</body>