<?php
/** @var $restaurants \App\Models\Restaurant|[] */
/** @var $categories \App\Models\Category|[] */
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
        <select style="margin-top:20px ;" name="category">
            <option value="Select Cuisine style">Select Cuisine style</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->name; ?>"><?= $category->name; ?></option>
            <?php endforeach; ?>
<!--            <option value="French">French</option>-->
<!--            <option value="European">European</option>-->
<!--            <option value="Asian">Asian</option>-->
<!--            <option value="International">International</option>-->
<!--            <option value="Fish and seafood">Fish and seafood</option>-->
<!--            <option value="Steakhouse">Steakhouse</option>-->
<!--            <option value="Argentinian">Argentinian</option>-->
<!--            <option value="Modern">Modern</option>-->
        </select>
    </center>
    <div class="box">
        <?php foreach ($restaurants as $restaurant): ?>
            <img alt="<?= $restaurant->Name; ?>" src="" width="400px" height="250px" >
            <div class="food">
                <a class="color" href=""><button >Reserve</button></a>
                <?= $restaurant->Name; ?> <br>
                <?= $restaurant->Address; ?> <br>
                Haarlem, Nederland <br>
                <br>
<!--                First session: 18:00 <br>-->
<!--                Duration; 1,5 hours <br>-->
<!--                Price: €45,00 (excluding €10,00 reservation fee)<br>-->
<!--                Cuisine: Dutch, fish and seafood, European-->
            </div>
        <?php endforeach; ?>
<!--        <img src="img/food/Mr.%20&%20Mrs..png" width="400px" height="250px" >-->
<!--        <div class="food">-->
<!--            <a class="color" href=""><button >Reserve</button></a>-->
<!--            Restaurant Mr. & Mrs <br>-->
<!--            Lange Veerstraat 4, 2011 DB <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 18:00 <br>-->
<!--            Duration; 1,5 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee)<br>-->
<!--            Cuisine: Dutch, fish and seafood, European-->
<!--        </div>-->
<!---->
<!---->
<!--        <img src="img/food/Ratatouille.png" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href="https://www.ratatouillefoodandwine.nl/index.html"><button >Reserve</button></a>-->
<!--            Ratatouille <br>-->
<!--            Spaarne 96, 2011 CL <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:00 <br>-->
<!--            Duration: 2 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: Dutch, fish and seafood, European-->
<!--        </div>-->
<!---->
<!--        <img src="img/food/Restaurant%20ML.jpg" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href="https://www.mlinhaarlem.nl/en/restaurant/reservations/"><button >Reserve</button></a>-->
<!--            Restaurant ML <br>-->
<!--            Kleine Houstraat, 2011 DR <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:00 <br>-->
<!--            Duration: 2 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: Dutch, fish and seafood, European-->
<!--        </div>-->
<!---->
<!--        <img src="img/food/Restaurant%20Fris.jpg" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href=""><button >Reserve</button></a>-->
<!--            Restaurant Fris <br>-->
<!--            Twijnderslaan 7, 2012 BG <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:30 <br>-->
<!--            Duration: 1,5 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: Dutch, French, European-->
<!--        </div>-->
<!---->
<!--        <img src="img/food/Specktakel.jpg" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href=""><button >Reserve</button></a>-->
<!--            Specktakel <br>-->
<!--            Spekstraat 4, 2011 HM <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:00 <br>-->
<!--            Duration: 1,5 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: European, International, Asian-->
<!--        </div>-->
<!---->
<!--        <img src="img/food/Grand%20Cafe%20Brinkmann.png" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href=""><button >Reserve</button></a>-->
<!--            Grand Cafe Brinkmann <br>-->
<!--            Grote Markt 13, 2011 RC <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:00 <br>-->
<!--            Duration: 1,5 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: Dutch, European, Modern-->
<!--        </div>-->
<!---->
<!--        <img src="img/food/Urban%20Frenchy%20Bistro%20Toujours.png" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href=""><button >Reserve</button></a>-->
<!--            Urban Frenchy Bistro Toujours <br>-->
<!--            Oude Groenmarkt 10-12, 2011 HL <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:00 <br>-->
<!--            Duration: 1,5 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: Dutch, fish and seafood, European-->
<!--        </div>-->
<!---->
<!--        <img src="img/food/The%20Golden%20Bull.png" width="400px" height="250px" style="padding-top: 40px;">-->
<!--        <div class="food" style="margin-top: 40px;">-->
<!--            <a class="color" href=""><button >Reserve</button></a>-->
<!--            The Golden Bull <br>-->
<!--            Zijlstraat 39, 2011 TK <br>-->
<!--            Haarlem, Nederland <br>-->
<!--            <br>-->
<!--            First session: 17:00 <br>-->
<!--            Duration: 1,5 hours <br>-->
<!--            Price: €45,00 (excluding €10,00 reservation fee) <br>-->
<!--            Cuisine: Steakhouse, Argentinian, European-->
<!--        </div>-->
    </div>
</div>

</body>
</head>
</html>