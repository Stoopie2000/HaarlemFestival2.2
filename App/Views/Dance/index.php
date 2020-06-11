<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Dance</title>
    <?php
    use App\Config;


include(dirname(dirname(__FILE__)) . "/Default/website_head.html")

    /**
     *  @var array $venues
     *  @var array $artists
     *  @var array $concerts
     *  @var array $plays_at
     * @var DateTime $firstDay
     * @var DateTime $finalDay
     *  @author Bram Bos <brambos27@gmail.com>
     */

    ?>
    <link rel="stylesheet" href="/css/Dance/danceStyle.css">
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.php") ?>
<main>
    <div class="searchContainer">
        <form>
          <label for="livesearch">Zoeken in dance event </label>
            <input type="text" size="30" onkeyup="showResult(this.value)">
            <div class="searchSuggestions" id="livesearch"></div>
        </form>
    </div>
    <div class="titleContainer">
        <h1>Haarlem Dance 2020</h1>
        <h2><?php echo date_format($firstDay, 'l d F') . " - " . date_format($finalDay, 'l d F') ?></h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 locationContainer">
                <h2>Locations</h2>
                <hr>
                    <?php
                    foreach ($venues as $venue) {
                        echo("<li style='list-style-type: none;'><a href='dance/locations/" . strtolower(str_replace(' ', '-', $venue->Name)) . "'> $venue->Name </a></li>");
                    }
                ?>
            </div>
            <div class="col-sm-6 artistContainer">
                <h2>Line Up</h2>
                <hr>
                <?php
                    foreach ($artists as $artist) {
                        echo("<li style='list-style-type: none;'><a href='dance/lineup/" . strtolower(str_replace(' ', '-', $artist->UnAccentedName)). "'> $artist->Name </a></li>");
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
                        echo("<h2>" . date_format($concert->Date, 'l d F') . " </h2>");
                    }

                    foreach ($venues as $item) {
                        if ($item->VenueID == $concert->VenueID) {
                            $venue = $item;
                        }
                    }

                    $concertArtists = [];
                    foreach ($concert->Artists as $artist) {
                      if (!empty($artist)){
                          $concertArtists[] = $artist->Name;
                      }
                    }
                    $concertArtistsNames = implode(", ", $concertArtists);

                    echo("<li style='list-style-type: none;'>" . date_format($concert->StartTime, 'G:i') . " - " . date_format($concert->EndTime, 'G:i') . " $venue->Name: <b>$concertArtistsNames</b></li>");
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</main>
</body>

<script>
    function showResult(str) {
        if (str.length==0) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("livesearch").innerHTML=this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET","dance/search?q="+str,true);
        xmlhttp.send();
    }
</script>