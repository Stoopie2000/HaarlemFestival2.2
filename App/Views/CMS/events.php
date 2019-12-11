<?php
    require 'inc/header.php';

    // if login than show nav
    if (true) {
        require 'inc/nav.php';
    // require 'inc/account.php';
    } else {
        echo '<div class="navbar1"></div>';
    }
?>

<div class="content">
    <div class="container">
        <div class="title">
            <h1 class="content_center">
                <?php echo ucfirst($params["event"]); ?>
            </h1>
        </div>
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-10">
                <div class="listview"><?php
                    foreach ($concerts as $concert) {
                        echo("<div class='listitem'><div class='litop'><div class='litoptext'>");
                        echo explode(" ", $concert->Date)[0];
                        echo("</div><div class='litoptext'>");
                        echo explode(" ", $concert->Date)[1] . " " . explode(" ", $concert->Date)[2];
                        echo("</div><div class='litoptext'>");
                        foreach ($concert->Artists as $artist) {
                            echo $artist->Name . ", ";
                        };
                        echo("</div><div class='litoptext'>");
                        echo(date_format($concert->StartTime, 'G:i') . " - " . date_format($concert->EndTime, 'G:i'));
                        echo("</div></div><div class='libottom'><div class='libottomtext'>Location:</br>");
                        echo $concert->Venue->Name;
                        echo("</div><div class='libottomtext'>Hall:</br>");
                        echo $concert->Venue->Hall;
                        echo("</div><div class='libottomtext'>Seats:</br>");
                        echo $concert->Venue->SeatingCapacity;
                        echo("</div><div class='libottomtext'>Price:</br>");
                        echo("€ " . printf("%1\$.2f", $concert->Price));
                        echo("</div></div>");
                    }?>
                        <!--<div class="libottom">
                            <div class="libottomtext">Location:</br>Patronaat</div>
                            <div class="libottomtext">Hall:</br>Main Hall</div>
                            <div class="libottomtext">Seats:</br>300</div>
                            <div class="libottomtext">Price:</br>€ 15,00</div>
                        </div>-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require 'inc/footer.html';
?>
