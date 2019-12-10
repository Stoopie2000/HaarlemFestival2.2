<?php 
    require 'inc/header.php';

    // if login than show nav
    if(true){
        require 'inc/nav.php';
        // require 'inc/account.php';
    } else{
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
            <div class="container col-4">

            </div>
            <div class="container col-8">
                <div class="listview"></div>
            </div>
        </div>
    </div>
</div>

<?php
    require 'inc/footer.html';
?>
