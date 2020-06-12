<?php use App\Config; ?>
<div class="text-center title_bar">
    <h1><strong>Haarlem festival <small>CMS</small></strong>

<?php if (isset($_SESSION["user_id"])) { ?>
    <button class="btn btn-secondary float-right log-out" onclick="window.location.href = '<?php echo Config::URLROOT; ?>/cms/logout'" >Log out</button>
<?php } ?>
</h1></div>