<?php
/** @var $restaurants \App\Models\Restaurant|[] */
/** @var $categories \App\Models\Category|[] */
/** @var $categories \App\Models\RestaurantCategory|[] */
?>
<html>
<head>
    <title>
        Haarlem festival
    </title>
    <link href="css/food/foodStyle.css" rel="stylesheet">
<body>
<header>
    <div class="angle"></div>

    <nav><p style="transform: skew(27deg);">Haarlem Festival <b style="float: Right; padding-right: 20px;">Login</b></nav>
    <div class="top-left"><img src="https://cdn.discordapp.com/attachments/648122388286013440/648122460121595904/Logo_pic.png" width="100px" height="100px" ></div>
    <div class="text"></div>
    <div class="nav2">
        <b>
            <a class="a" href="#">Home</a>
            <a class="a" href="#">Jazz</a>
            <a class="a" href="#">Dance</a>
            <a class="a" href="#">Food</a>
            <a class="a" href="#">Historic</a>
        </b>
    </div>

    <img src="img/food/banner pic.jpg" width="100%" height="60%">

    <div class="top-right"><p><b>Cart</b></p>
        <div class="anglee">
        </div>
    </div>

</header>
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
        <div class="restaurant" style="position: relative;">
            <img alt="<?= $restaurant->image_description; ?>" src="<?= $restaurant->image_url; ?>" width="400px" height="250px" >
            <div class="food">
                <button type="button" data-event="reserve" data-restaurant="<?= $restaurant->Name; ?>">Reserve</button>

                <?= $restaurant->Name; ?> <br>
                <?= $restaurant->Address; ?> <br>
                <?= $restaurant->CityAndCountry; ?> <br>
                <br>
                First session: <?= $restaurant->FirstSession; ?> <br>
                Duration: <?= $restaurant->SessionDuration; ?> hours <br>
                Price: €<?= $restaurant->Price; ?> (including €10 reservation fee, half price for kids below 12 years old) <br>
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
            Price: €<?= $restaurant->Price; ?> (including €10 reservation fee, half price for kids below 12 years old) <br>
            <span class="cuisine">Cuisine: <?= $restaurant->categories; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="//code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="/js/food.js"></script>

</body>
</head>
</html>