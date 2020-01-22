<?php
    use App\Config;

    require 'inc/header.php';

    require 'inc/nav.php';

?>
<div class="content" id="dashboard">
    <div class="container">
        <div class="title">
            <h1 class="content_center">
                <?php echo ucfirst($params["action"]); ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="btn-big btn-big-style container">
                <a href="<?php echo Config::URLROOT; ?>/cms/users"><div class="btn-big correction">
                    <h3 class="btn-big-center"><?php echo $users->Number; ?> users<i class="fas fa-users"></i></h3>
                    <div class="under-title"><h5 class="text-center">Users</h5></div>
                    <div class="under-title-info"><h5 class="text-center">Users</h5><h6 class="text-center">Edit and remove</h6></div>
                </div></a>
            </div>
        </div>
        <div class="col">
                <div class="btn-big btn-big-style container no-padding">
                    <a href="<?php echo Config::URLROOT; ?>/cms/events/jazz"><div class="btn-small firstbtn">Jazz</div></a>
                    <a href="<?php echo Config::URLROOT; ?>/cms/events/dance"><div class="btn-small">Dance</div></a>
                    <a href="<?php echo Config::URLROOT; ?>/cms/events/food"><div class="btn-small">Food</div></a>
                    <div class="underTitle"><h5 class="text-center">Events</h5></div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="btn-big-style btn-pages container">
            <div class="correction">
                <?php for ($i=0; $i < count($params["pages"]); $i++) { 
                    echo "<a href='". Config::URLROOT ."/cms/pages/". $params["pages"][$i]->Name ."'>";
                    echo "<div class='btn-smaller ";
                    if ($i == 0) {
                        echo "firstbtn";
                    }
                    echo "'>";
                    echo ucfirst($params["pages"][$i]->Name);
                    echo "</div></a>";
                }
                ?>
                <div class="underTitle"><h5 class="text-center">Pages</h5></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="btn-big btn-big-style container">
                <a href="<?php echo Config::URLROOT; ?>/cms/artists"><div class="btn-big correction">
                    <h3 class="btn-big-center"><?php echo $artists->Number; ?> artists<i class="fas fa-guitar"></i></h3>
                    <div class="under-title"><h5 class="text-center">Artists</h5></div>
                    <div class="under-title-info"><h5 class="text-center">Artists</h5><h6 class="text-center">Edit, remove and add</h6></div>
                </div></a>
            </div>
        </div>
        <div class="col">
            <div class="btn-big btn-big-style container">
                <a href="<?php echo Config::URLROOT; ?>/cms/finance"><div class="btn-big correction">
                    <h3 class="btn-big-center"><?php echo $orders->Number; ?> orders<i class="fas fa-receipt"></i></i></h3>
                    <div class="under-title"><h5 class="text-center">Finance</h5></div>
                    <div class="under-title-info"><h5 class="text-center">Finance</h5><h6 class="text-center">See and download orders</h6></div>
                </div></a>
            </div>
        </div>
    </div>
</div>

<script>
</script>

<?php
    require 'inc/footer.html';
?>