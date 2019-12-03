<html>
<head>
    <title>
        Haarlem festival
    </title>
    <style>
        .top-left {
            position: absolute;
            top: 8px;
            left: 8px;
            background-color: white;
            opacity: 0.5;
            display: inline-block;
        }
        .angle{
            border-style: solid;
            border-width: 100px 50px 0 0;
            border-color: white transparent transparent transparent;
            float: left;
            position: absolute;
            opacity: 0.5;
            left: 108px;
        }
        nav{
            width: 85.9%;
            height: 50px;
            transform: skew(-27deg);
            background: #363636;
            float: left;
            position: absolute;
            text-align: center;
            left: 146px;
            color: white;
            border-right: 1px solid white;
        }
        .top-right {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: #363636;
            display: inline-block;
            height: 100px;
            width: 100px;
            color: white;
        }
        .anglee{
            border-style: solid;
            border-width: 0 0px 100px 50px;
            border-color: transparent transparent #363636 transparent;
            right: 100px;
            float: right;
            position: absolute;
            top: 0px;
        }
        .nav2{
            width: 86.1%;
            height: 50px;
            transform: skew(-27deg);
            background: #363636;
            float: left;
            position: absolute;
            left: 121px;
            color: white;
            top: 58px;
            opacity: 0.5;
        }
        .a{
            height: 40px;
            width: 90px;
            float: left;
            Margin-left: 30px;
            font-size: 20px;
            color: white;
            text-align: center;
            padding-top: 10px;
            opacity: 1;
            text-decoration: none;
            transition: 1s;
        }
        .a:hover{
            background-color: #EB954A;

        }
        .text{

            bottom: 8px;
            left: 8px;
            background-color: white;

            display: inline-block;
        }
        .container{
            width: 100%;
            height: 330%;
            background-color: #FF9E00;
            color: white;
            position: relative;
        }
        .box{
            margin-left:12%;
            margin-right: 12%;
            margin-top:30px;
            color:#333333;
            background-color: #FFC464;
            height: 72.6%;
            width: 76%;
            font-size: 24px;
        }
        .food{
            height: 250px;
            width: 800px;
            background-color: #FFB339;
            float: right;
        }
        button{
            background-color: #C67A00;
            border: 2px solid #797979;
            padding:20px;
            width: 150px;
            height: 90px;
            float: right;
            top: 0px;
        }
    </style>
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
        <select style="margin-top:20px ;">
            <option value="Select Cuisine style">Select Cuisine style</option>
            <option value="Any Cuisine">Any Cuisine</option>
            <option value="Dutch">Dutch</option>
            <option value="French">French</option>
            <option value="European">European</option>
            <option value="Asian">Asian</option>
            <option value="International">International</option>
            <option value="Fish and seafood">Fish and seafood</option>
            <option value="Steakhouse">Steakhouse</option>
            <option value="Argentinian">Argentinian</option>
            <option value="Modern">Modern</option>
        </select>
    </center>
    <div class="box">

        <img src="img/food/Mr.%20&%20Mrs..png" width="400px" height="250px" >
        <div class="food">
            <a class="color" href=""><button >Reserve</button></a>
            Restaurant Mr. & Mrs <br>
            Lange Veerstraat 4, 2011 DB <br>
            Haarlem, Nederland <br>
            <br>
            First session: 18:00 <br>
            Duration; 1,5 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee)<br>
            Cuisine: Dutch, fish and seafood, European
        </div>


        <img src="img/food/Ratatouille.png" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href="https://www.ratatouillefoodandwine.nl/index.html"><button >Reserve</button></a>
            Ratatouille <br>
            Spaarne 96, 2011 CL <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:00 <br>
            Duration: 2 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: Dutch, fish and seafood, European
        </div>

        <img src="img/food/Restaurant%20ML.jpg" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href="https://www.mlinhaarlem.nl/en/restaurant/reservations/"><button >Reserve</button></a>
            Restaurant ML <br>
            Kleine Houstraat, 2011 DR <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:00 <br>
            Duration: 2 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: Dutch, fish and seafood, European
        </div>

        <img src="img/food/Restaurant%20Fris.jpg" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href=""><button >Reserve</button></a>
            Restaurant Fris <br>
            Twijnderslaan 7, 2012 BG <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:30 <br>
            Duration: 1,5 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: Dutch, French, European
        </div>

        <img src="img/food/Specktakel.jpg" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href=""><button >Reserve</button></a>
            Specktakel <br>
            Spekstraat 4, 2011 HM <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:00 <br>
            Duration: 1,5 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: European, International, Asian
        </div>

        <img src="img/food/Grand%20Cafe%20Brinkmann.png" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href=""><button >Reserve</button></a>
            Grand Cafe Brinkmann <br>
            Grote Markt 13, 2011 RC <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:00 <br>
            Duration: 1,5 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: Dutch, European, Modern
        </div>

        <img src="img/food/Urban%20Frenchy%20Bistro%20Toujours.png" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href=""><button >Reserve</button></a>
            Urban Frenchy Bistro Toujours <br>
            Oude Groenmarkt 10-12, 2011 HL <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:00 <br>
            Duration: 1,5 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: Dutch, fish and seafood, European
        </div>

        <img src="img/food/The%20Golden%20Bull.png" width="400px" height="250px" style="padding-top: 40px;">
        <div class="food" style="margin-top: 40px;">
            <a class="color" href=""><button >Reserve</button></a>
            The Golden Bull <br>
            Zijlstraat 39, 2011 TK <br>
            Haarlem, Nederland <br>
            <br>
            First session: 17:00 <br>
            Duration: 1,5 hours <br>
            Price: €45,00 (excluding €10,00 reservation fee) <br>
            Cuisine: Steakhouse, Argentinian, European
        </div>
    </div>
</div>

</body>
</head>
</html>