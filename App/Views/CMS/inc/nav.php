<?php 
    use App\Config;
?>

<div class="navbar1">
    <nav class="nav flex-column nav-fill">
        <a class="menu menu-head<?php 
            // Short if else statement ({condition} ? {code if true} : {code if false})
            //echo ($params["action"] == 'login' ? ' active' : '');
            if ($params["action"] == "login") {
                echo " active"; 
            };
        ?>" href="<?php echo Config::URLROOT; ?>/cms">Menu</a>
        <a class="menu menu-item<?php echo ($params["action"] == 'users' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/users">Users</a>
        <a class="menu menu-item dropdown-toggle" href="#Pages" role="button" data-toggle="collapse">Pages</a>
            <div class="collapse<?php echo ($params["action"] == 'pages' ? ' show' : ''); ?>" id="Pages"><?php
                foreach ($params["pages"] as $page) {
                    echo ("<a class='menu menu-sub" . ($params["action"] == 'pages' && $params["event"] == strtolower($page->Name) ? ' active' : '') . "' href='". Config::URLROOT ."/cms/pages/". strtolower($page->Name) ."'>". $page->Name . "</a>");
                }?>
                <a class="menu menu-sub<?php echo ($params["action"] == 'pages' && $params["event"] == 'new' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/pages/new">New</a>
            </div>
        <a class="menu menu-item dropdown-toggle" href="#Events" role="button" data-toggle="collapse">Events</a>
            <div class="collapse<?php echo ($params["action"] == 'events' ? ' show' : ''); ?>" id="Events">
                <a class="<?php echo ($params["action"] == 'events' && $params["event"] == 'jazz' ? 'active ' : ''); ?>menu menu-sub" href="<?php echo Config::URLROOT; ?>/cms/events/jazz">Jazz</a>
                <a class="menu menu-sub<?php echo ($params["action"] == 'events' && $params["event"] == 'dance' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/events/dance">Dance</a>
                <a class="menu menu-sub<?php echo ($params["action"] == 'events' && $params["event"] == 'food' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/events/food">Food</a>
            </div>
        <a class="menu menu-item<?php echo ($params["action"] == 'artists' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/artists">Artists</a>
        <!--<a class="menu menu-item<?php echo ($params["action"] == 'finance' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/restaurants">Restaurants</a>-->
        <a class="menu menu-item<?php echo ($params["action"] == 'finance' ? ' active' : ''); ?>" href="<?php echo Config::URLROOT; ?>/cms/finance">Finance</a>
    </nav>
</div>

<?php /* A dropdown at hover
            <div class="submenu nav flex-column nav-fill">
                <a class="menu menu-item dropdown-toggle" href="<?php echo Config::URLROOT; ?>/cms/event" id="Event">Events</a>
                <div class="sub" id="nav">
                    <a class="menu menu-sub" href="<?php echo Config::URLROOT; ?>/cms/event?jazz">Jazz</a>
                    <a class="menu menu-sub" href="#">Dance</a>
                    <a class="menu menu-sub" href="#">Food</a>
                </div>
            </div>
        */?>