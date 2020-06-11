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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="progress" style="height: 55px;">
                        <?php
                        foreach ($items as $item)

                            echo ("<div class=\"progress-bar\" role=\"progressbar\" style=\"width: 15%;background-color: $item->color\" aria-valuenow=\"15\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>")

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>