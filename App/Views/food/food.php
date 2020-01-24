<?php
/** @var $restaurants \App\Models\Restaurant|[] */
/** @var $categories \App\Models\Category|[] */
/** @var $categories \App\Models\RestaurantCategory|[] */
/** @var $dates \App\Models\Date */

use App\Config;

include(dirname(dirname(__FILE__)) . "/Default/navigation.html");
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['return_to'] = $_SERVER['REDIRECT_URL'];
?>
<html lang="NL">
<head>
    <title>
        Haarlem festival
    </title>
    <link href="css/food/foodStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Config::URLROOT; ?>css/Default/Navigation.css">
</head>
<body>
<div class="logo">
    <img src="<?php echo Config::URLROOT; ?>/img/haarlem-logo-png-transparent.png" alt="Logo Haarlem" width="180"
         height="150">
</div>

<div class="background">
    <img src="<?php echo Config::URLROOT; ?>/img/food/banner pic.jpg" alt="Banner pic Food" width="100%">
</div>

<div class="container">
    <center>
        <select style="margin-top:20px ;" name="category" data-event="filter">
            <option value="Select Cuisine style">Select Cuisine style</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->name; ?>"><?= $category->name; ?></option>
            <?php endforeach; ?>
        </select>
    </center>
    <div class="box">
        <?php foreach ($restaurants as $restaurant): ?>
            <div class="restaurant-box" style="position: relative;">
                <div class="restaurant" style="position: relative;">
                    <img alt="<?= $restaurant->image_description; ?>" src="<?= $restaurant->image_url; ?>" width="400px"
                         height="250px">
                    <div class="food">
                        <button type="button" data-event="reserve" data-restaurant="<?= $restaurant->Name; ?>">Reserve
                        </button>

                        <?= $restaurant->Name; ?> <br>
                        <?= $restaurant->Address; ?> <br>
                        <?= $restaurant->CityAndCountry; ?> <br>
                        <br>
                        First session: <?= $restaurant->FirstSession; ?> <br>
                        Duration: <?= $restaurant->SessionDuration; ?> hours <br>
                        Price: €<?= $restaurant->Price; ?> (including €10 reservation fee, half price for kids below 12
                        years old) <br>
                        <span class="cuisine">Cuisine: <?= $restaurant->categories; ?></span>
                    </div>
                </div>
                <div class="reserve" data-restaurant-name="<?= $restaurant->Name; ?>" style="opacity: 0;">
                    <button type="button" data-event="cancel" data-restaurant="<?= $restaurant->Name; ?>">
                        Back
                    </button>
                    <?= $restaurant->Name; ?> <br>
                    <?= $restaurant->Address; ?> <br>
                    <?= $restaurant->CityAndCountry; ?> <br>
                    <br>
                    First session: <?= $restaurant->FirstSession; ?> <br>
                    Duration: <?= $restaurant->SessionDuration; ?> hours <br>
                    Price: €<?= $restaurant->Price; ?> (including €10 reservation fee, half price for kids below 12
                    years old) <br>
                    <span class="cuisine">Cuisine: <?= $restaurant->categories; ?></span> <br>
                    <br>
                    <form method="get" action="/order/addItems">

                        <input type="hidden" name="productType" value="restaurant"">
                        <input type="hidden" name="restaurantID" value="<?= $restaurant->RestaurantID; ?>"">

                    Date: <select name="DateSelection">
                        <option value="DateSelect">Select date</option>
                        <?php foreach ($dates as $date): ?>
                            <option value="<?= date_format($date->Date,"Y-m-d"); ?>"><?= date_format($date->Date,"d-m-Y"); ?></option>
                        <?php endforeach; ?>
                    </select> <br>

                    <br>
                    Time: <select name="TimeSelection">
                        <option value="TimeSelect">Select time</option>
                        <?php
                        for ($i = 0; $i < $restaurant->TotalSessions; $i++)
                        {
                            $firstItem = $restaurant->FirstSession;
                            // FirstSession is a string
                            $d = new DateTime($restaurant->FirstSession);
                            // SessionDuration is a double, in hours in double
                            // let's convert in minutes
                            $timespan = $i*60*$restaurant->SessionDuration;
                            $dv = new DateInterval('PT'.$timespan.'M');
                            $d->add($dv);
                            $secondItem = $d->format('H:i:s');

                            // Here you can use $firstItem and $secondItem for your dropdown
                            echo "<option value=\"".$secondItem."\">".$secondItem."</option>";
                        }
                        ?>
                    </select> <br>
                    <br>
                    Seats: <input type="text" name="Quantity" placeholder="Seats"> <br>
                    <br>
                    Comments: <br>
                    <textarea name="Comments" placeholder="Comments" rows="5" style="width: 75%"></textarea>
                    <button type="submit" data-restaurant="<?= $restaurant->Name; ?>">
                        Reserve
                    </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="//code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="/js/food.js"></script>

</body>
</html>