<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Dance</title>
    <?php
    use App\Config;

    include(dirname(dirname(__FILE__)) . "/Default/website_head.html")?>
    <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>/css/Dance/danceStyle.css">
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html") ?>
<main style="margin-top: 200px ">
    <div class="titleContainer">
        <h1>Haarlem Dance 2020</h1>
        <h2>23 July - 26 July</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 locationContainer">
                <h2><a href="location/index">Locations</a></h2>
                <hr>
                    <?php
                    foreach ($venues as $venue) {
                        echo("<li style='list-style-type: none;'><a href='dance/locations/" . strtolower(str_replace(' ', '-', $venue->Name)) . "'> $venue->Name </a></li>");
                    }
                ?>
            </div>
            <div class="col-sm-6 artistContainer">
                <h2><a href="lineup/index">Line Up</a></h2>
                <hr>
                <?php
                    foreach ($artists as $artist) {
                        echo("<li style='list-style-type: none;'><a href='dance/lineup/" . strtolower(str_replace(' ', '-', $artist->Name)) . "'> $artist->Name </a></li>");
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 calendarContainer">
                <ul style="padding: 0">
                <?php
                foreach ($concerts as $concert) {
                    if (isset($currentConcertDate) && $currentConcertDate != $concert->Date) {
                        unset($currentConcertDate);
                    }
                    if (!isset($currentConcertDate)) {
                        $currentConcertDate = $concert->Date;
                        echo("<h2> $concert->Date</h2>");
                    }

                    foreach ($venues as $item) {
                        if ($item->VenueID == $concert->VenueID) {
                            $venue = $item;
                        }
                    }

//                    $plays_at_array = [];
//                    foreach ($plays_at as $item) {
//                        if ($item->ConcertID == $concert->ConcertID) {
//                            array_push($plays_at_array, $item);
//                        }
//                    }
//
//                    $concertArtists = [];
//                    foreach ($plays_at_array as $item) {
//                        foreach ($artists as $artist) {
//                            if ($item->ArtistID == $artist->ArtistID) {
//                                array_push($concertArtists, $artist->Name);
//                            }
//                        }
//                    }

                    $concertArtists = [];
                    foreach ($concert->Artists as $artist) {
                        $concertArtists[] = $artist->Name;
                    }
                    $concertArtistsNames = implode(", ", $concertArtists);

                    echo("<li style='list-style-type: none;'>$concert->StartTime - $concert->EndTime $venue->Name: <b>$concertArtistsNames</b></li>");
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</main>
</body>