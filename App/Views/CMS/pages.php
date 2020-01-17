<?php
    use App\Config;

    require 'inc/header.php';

    require 'inc/nav.php';
?>

<div class="content"  id="pages">
    <div class="container">
        <div class="title">
            <h1 class="content_center" id="Title">
                <?php echo ucfirst($params["event"]); ?>
            </h1>
        </div>
    </div>
    <div class="menu-row">
        <h3>Main</h3>
        <hr>
    </div>
    <form id="main" action="<?php echo(Config::URLROOT ."/cms/pages/". strtolower($currentPage->Name));?>" onsubmit="return Control('main')" method="post">
        <div class="content-row">
            <h4>Information:</h4>
            <textarea name="description" id="description"><?php echo $currentPage->Description; ?></textarea>
        </div>
        <div class="content-row">
            <h4>Background:</h4>
            <img src="<?php echo Config::URLROOT;?>/img/home/<?php echo $currentPage->Background; ?>" height="100">
            <div class="custom-file">
                <input name="file" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="Validate('main')">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <div class="content-row">
            <button type="submit" value="Submit" class="btn btn-success save-button">Save</button>
            <div></div>
            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo Config::URLROOT; ?>/cms/pages/<?php echo strtolower($currentPage->Name); ?>'">Cancel</button>
        </div>
    </form><?php
        if (isset($venues)) {
            foreach ($venues as $venue) {
                echo "<div class='menu-row'><h3>". $venue->Name ."</h3><hr></div>";
                echo "<form id='". $venue->VenueID ."' action='". Config::URLROOT ."/cms/pages/". strtolower($currentPage->Name) ."' onsubmit='return Control(". $venue->VenueID .")' method='post'>";
                echo "<div class='content-row'><h4>Information:</h4><textarea name='description' id='description'>" .$currentPage->Description ."</textarea></div>";
                echo "<div class='content-row'><h4>Background:</h4><img src='". Config::URLROOT ."/img/". strtolower($currentPage->Name) ."/". $venue->Image ."' height='100'>";
                echo "<div class='custom-file'><input type='file' class='custom-file-input' id='inputGroupFile". $venue->VenueID ."' aria-describedby='inputGroupFileAddon01' onchange='Validate(". $venue->VenueID .")'><label class='custom-file-label' for='inputGroupFile". $venue->VenueID ."'>Choose file</label></div></div>";
                echo "<div class='content-row'><button type='submit' value='Submit' class='btn btn-success save-button'>Save</button><div></div>";
                echo "<button type='button' class='btn btn-danger' onclick=\"location.href='". Config::URLROOT ."/cms/pages/". strtolower($currentPage->Name) ."'\">Cancel</button>";
                echo "</div></form>";
            }
        }
?></div>

<script>
    function Control(id){
        if (Validate(id)) {
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
