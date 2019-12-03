<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Dance</title>
    <?php
    use App\Models\Artist;
    use App\Models\Concert;
    use App\Models\Venue;
    use App\Config;

    include(dirname(dirname(__FILE__)) . "/Default/website_head.html")?>
    <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>/css/Dance/danceStyle.css"
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
                    /** @var array $venues */
                    foreach ($venues as $venue) {
                        echo ("<li style='list-style-type: none;'><a href='location/$venue->Name'> $venue->Name </a></li>");
                    }
                ?>
            </div>
            <div class="col-sm-6 artistContainer">
                <h2><a href="lineup/index">Line Up</a></h2>
                <hr>
                <?php
                    /** @var array $artists */
                    foreach ($artists as $artist){
                        echo ("<li style='list-style-type: none;'><a href='lineup/$artist->Name'> $artist->Name </a></li>");
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 calendarContainer">
                <?php
                /** @var array $concerts
                 *  @var array $plays_at
                 */
                foreach ($concerts as $concert){
                    if (isset($date) && $date != DateTime::createFromFormat('Y-m-d', $concert->Date)->format('l d F')){
                        unset($currentConcertDate);
                    }
                    if (!isset($currentConcertDate)){
                        $currentConcertDate = $concert->Date;
                        $date = DateTime::createFromFormat('Y-m-d', $currentConcertDate);
                        $date = $date->format('l d F');
                        echo ("<h2> $date</h2>");
                    }

                    foreach ($venues as $item){
                        if ($item->VenueID == $concert->VenueID){
                            $venue = $item;
                        }
                    }

                    $plays_at_array = [];
                    foreach ($plays_at as $item){
                            if ($item->ConcertID == $concert->ConcertID){
                                array_push($plays_at_array, $item);
                            }
                    }

                    $concertArtists = [];
                    foreach ($plays_at_array as $item){
                        foreach ($artists as $artist)
                        if ($item->ArtistID == $artist->ArtistID){
                            array_push($concertArtists, $artist->Name);
                        }
                    }

                    $concertArtistsNames = implode(", ", $concertArtists);
                    $startTime = DateTime::createFromFormat('H:i:s', $concert->StartTime)->format('H:i');


                    echo ("<li style='list-style-type: none;'>$startTime $venue->Name: <b>$concertArtistsNames</b></li>");
                }
                ?>
            </div>
        </div>
    </div>
</main>
</body>