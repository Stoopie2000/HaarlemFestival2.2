<html lang="en">
<head>
    <title>Haarlem Dance</title>
    <?php
    use App\Config;
    include(dirname(dirname(__FILE__)) . "/Default/website_head.html")

    ?>
</head>
<body id="crossSellingPage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php") ?>

    <main class="pt-3">
        <div class="food_container">
            <div class="row">
                <div class="col-12">
                    <?php
                    echo ("Minute per percentage: " . $timeline->MinutePerPercentage . "</br>");
                    echo ("Timeline Start: " . $timeline->StartTime->format('H:i') . " Timeline End: " . $timeline->EndTime->format('H:i'));
                    echo "</br>";
                    dump($timeline->StartTime->diff($timeline->EndTime));
                    echo "</br>";

                    foreach ($timeline->Tickets as $item)
                    echo ($item->ConcertID . " Duration in minutes: " . $item->getDurationInMinutes() . "</br>");
                    echo ("<div class=\"progress-bar\" role=\"progressbar\" style=\"width: " . $item->getDurationInMinutes() / $timeline->MinutePerPercentage . "%;background-color: $item->color\" aria-valuenow=\"15\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>")

                    ?>
                    <div class="progress" style="height: 55px;">
                        <?php
                        foreach ($timeline->Tickets as $item)
                            echo ("<div class=\"progress-bar\" role=\"progressbar\" style=\"width: " . $item->getDurationInMinutes() / $timeline->MinutePerPercentage . "%;background-color: $item->color\" aria-valuenow=\"15\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>")

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>