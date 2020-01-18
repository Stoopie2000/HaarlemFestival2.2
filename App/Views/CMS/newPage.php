<?php
    use App\Config;

    require 'inc/header.php';

    require 'inc/nav.php';
?>

<div class="content"  id="newpage">
    <div class="container">
        <div class="title">
            <h1 class="content_center" id="Title">
                <?php echo ucfirst($params["event"]); ?>
            </h1>
        </div>
    </div>
    <form id="main" action="<?php echo Config::URLROOT; ?>/cms/pages/new" onsubmit="return Control('main')" method="post" enctype="multipart/form-data">
        <div class="menu-row">
            <input name="name" type="text" class="form-control" placeholder="Page name">
            <hr>
        </div>
        <div class="content-row">
            <h4>Information:</h4>
            <textarea name="description" id="description" placeholder="Set information for the page"></textarea>
        </div>
        <div class="content-row">
            <h4>Background:</h4>
            <img src="" height="100">
            <div class="custom-file">
                <input name="file" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="Validate('main')">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <div class="content-row">
            <button type="submit" value="Submit" class="btn btn-success save-button">Save</button>
        </div>
    </form>
</div>

<script>
    function Control(id){
        if (Validate(id)) {
            var form = document.getElementById(id);
            var name = form.getElementsByTagName('input')[0];
            if (name.value.length <= 0) {
                alert("please fill in a page name to save");
                return false;
            }

            var description = form.getElementsByTagName('textarea')[0];
            if (description.value.length <= 0) {
                alert("please fill in a description to save");
                return false;
            }

            return true;
        } else {return false;}
    }

    function Validate(id){
        var validFileExtensions = [".jpg", ".jpeg", ".png"];
        var form = document.getElementById(id);
        var file = form.getElementsByTagName('input')[1].files[0];
        if (file != undefined) {
            var FileName = file.name;
            var blnValid = false;
            for (var i = 0; i < validFileExtensions.length; i++) {
                var sCurExtension = validFileExtensions[i];
                if (FileName.substr(FileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    var img = form.getElementsByTagName('img')[0];
                    img.src = window.URL.createObjectURL(file);
                    break;
                }
            }
                
            if (!blnValid) {
                alert("Sorry, " + FileName + " is invalid, allowed extensions are: " + validFileExtensions.join(", "));
                return false;
            }
            return true;
        } else {
            alert("please upload a image to save");
            return false; }
    }

</script>

<?php
    require 'inc/footer.html';
?>
