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
                <?php echo ucfirst($event); ?>
            </h1>
        </div>
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-10">
                <div class="listview">
                    <div class="listitem">
                        <div class="litop">
                            <div class="litoptext">Thursday</div>
                            <div class="litoptext">26 July</div>
                            <div class="litoptext">Tom Thomsom Assemble</div>
                            <div class="litoptext">18:00 - 19:00</div>
                        </div>
                        <div class="libottom">
                            <div class="libottomtext">Location:</br>Patronaat</div>
                            <div class="libottomtext">Hall:</br>Main Hall</div>
                            <div class="libottomtext">Seats:</br>300</div>
                            <div class="libottomtext">Price:</br>€ 15,00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require 'inc/footer.html';
?>
