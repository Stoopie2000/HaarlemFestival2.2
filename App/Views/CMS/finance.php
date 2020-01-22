<?php
    use App\Config;

    require 'inc/header.php';

    require 'inc/nav.php';

?>
<div class="content" id="finance">
    <div class="container">
        <div class="title">
            <h1 class="content_center">
                <?php echo ucfirst($params["action"]); ?>
            </h1>
            <?php echo ($download) ? "<a id='download' href='orders.csv' download='orders.csv'></a>" : '' ;?>
        </div>
        <div class="row container">
            <div class="lvheader">
                <div><input id="checkbox" class="check" type="checkbox" name="All" value="all" onchange="CheckAll()"></div>
                <div><a class="content_horizontal">User</a></div>
                <div><a class="content_horizontal">Concert</a></div>
                <div><a class="content_horizontal">Order</a></div>
                <div><a class="content_horizontal">Status</a></div>
                <div><a class="content_horizontal">Date of order</a></div>
                <div><a class="content_horizontal">Quantity</a></div>
            </div>
                <form action='<?php echo Config::URLROOT; ?>/cms/finance' method='post'>
                    <div class="listview" id="listview"><?php
                        foreach ($orders as $order) {
                            echo("<div class='lvitem' id='" . $order->OrderID . "'>");
                            echo("<div><input class='check' type='checkbox' name='orders[]' value='" . $order->OrderID . "'></div>");
                            echo("<div><a class='content_horizontal'><strong>" . $order->User->Email . "</strong></a></div>");
                            echo("<div><a class='content_horizontal'>" . $order->ConcertID . "</a></div>");
                            echo("<div><a class='content_horizontal'>" . $order->OrderID . "</a></div>");
                            echo("<div><a class='content_horizontal'>" . $order->Status . "</a></div>");
                            echo("<div><a class='content_horizontal'>" . $order->OrderDate->format('Y-m-d H:i:s') . "</a></div>");
                            echo("<div><a class='content_horizontal'>" . $order->Quantity . "</a></div>");
                            echo("</div>");
                        }?>
                    </div>
                    <button type="submit" class="btn btn-primary">Download</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('download').click();

    function CheckAll(){
        var listview = document.getElementById('listview');
        var inputs = listview.getElementsByTagName('input');
        var bool = document.getElementById('checkbox').checked;
        
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].checked = bool;
        }
    }
</script>

<?php
    require 'inc/footer.html';
?>