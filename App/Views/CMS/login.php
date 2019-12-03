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

</div>

<?php
    require 'inc/footer.html';
?>
