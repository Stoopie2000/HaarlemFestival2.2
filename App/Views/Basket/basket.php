<?php

use App\Config;

include(dirname(dirname(__FILE__)) . "/Default/website_head.html")
/**
 * @var array $basket
 *
 * @author Bram Bos <brambos27@gmail.com>
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haarlem Festival shopping basket</title>
    <link rel="stylesheet" href=""
</head>
<body id="dancePage" class="">
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation.html") ?>
<main>
    <div class="basketContainer container">
        <div class="row">
            <div class="col-sm-6">
                    <?php

                    foreach($basket->items as $basketItem){
                        echo <<<BASKETITEM
                      $basketItem->Description €$basketItem->Price $basketItem->Quantity
BASKETITEM;
                    }
                    ?>
            </div>
          <div class="col-sm-6">

          </div>
        </div>
    </div>
</main>
</body>