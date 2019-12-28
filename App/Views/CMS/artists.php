<?php
    use App\Config;

    require 'inc/header.php';

    // if login than show nav
    if (true) {
        require 'inc/nav.php';
    // require 'inc/account.php';
    } else {
        echo '<div class="navbar1"></div>';
    }
?>
<div class="content" id="artists">
    <div class="container">
        <div class="title">
            <h1 class="content_center">
                <?php echo ucfirst($params["action"]); ?>
            </h1>
        </div>
        <div class="row container">
            <div class="input-group mb-3">
                <input type="text" id="filter" onkeyup="filter()" class="form-control" placeholder="Artist" aria-label="Artist" aria-describedby="button-addon">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon">Button</button>
                </div>
            </div>
            <div class="lvheader">
                <div><a class="content_horizontal">ID</a></div>
                <div><a class="content_horizontal">Name</a></div>
                <div><a class="content_horizontal">Description</a></div>
                <div><a class="content_horizontal">Events</a></div>
            </div>
            <div class="listview" id="listview"><?php
                foreach ($artists as $artist) {
                    echo("<div class='lvitem' id='" . $artist->ArtistID . "'><div><a class='content_horizontal'><strong>" . $artist->ArtistID . "</strong></a></div>");
                    echo("<div><a class='content_horizontal'>" . $artist->Name . "</a></div>");
                    echo("<div><textarea readonly class='content_horizontal'>" . $artist->Description . "</textarea></div>");
                    echo("<div><a class='content_horizontal'>" . $artist->Event . "</a></div>");
                    echo("<div class='buttons'>");
                    echo("<button type='button' class='btn btn-secondary float-left' onclick='Edit(" . $artist->ArtistID . ")'><i class='far fa-edit fa-lg'></i>");
                    echo("<button type='button' class='btn btn-danger float-right' onclick='Delete(" . $artist->ArtistID . ")'><i class='far fa-trash-alt fa-lg'></i>");
                    echo("</div></div>");
                }?></div>
            <div>
                <button type="button" class="button btn btn-success" onclick="Create()">Add artist</button>
            </div>
            <div class="lightbox" id="lightbox">
                <div class="lbcontent">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="lbName"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideLightbox()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo Config::URLROOT; ?>/cms/artists" onsubmit="return control()" method="post">
                        <input id="id" name="id" type="hidden">
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Name:</label>
                          <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="Name" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Description:</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Event:</label>
                            <div class="col-sm-10">
                                <select name="event" class="custom-select" id="Event">
                                    <option value="Jazz" selected>Jazz</option>
                                    <option value="dance">Dance</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row content_center">
                        <button id="submit" type="submit" value="Submit"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filter(){
        var input, filter, lv, li, a, i, txtValue;
        input = document.getElementById('filter');
        filter = input.value.toUpperCase();
        lv = document.getElementById('listview');
        li = lv.getElementsByClassName('lvitem');

        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName('div')[1].getElementsByTagName('a')[0]; 
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }      
        }
    }

    function Clearlightbox(){
        document.getElementById('lbName').intertext = null;
        document.getElementById('Name').value = null;
        document.getElementById('Description').value = null;
        document.getElementById('Event').value = "";
    }

    function Create(){
        var lightbox = document.getElementById('lightbox');
        document.getElementById('lbName').innerText = "Create new artist";
        document.getElementById('Name').value = "";
        document.getElementById('Description').innerText = "";
        
        document.getElementById('submit').className = "button btn btn-success";
        document.getElementById('submit').innerText = "Create";
        lightbox.style.display = "block";
    }

    function Edit(id){
        var lightbox = document.getElementById('lightbox');
        document.getElementById('lbName').innerText = "Edit artist";
        var li = document.getElementById(id)
        var a = li.getElementsByTagName('div');
        document.getElementById('id').value = a[0].getElementsByTagName('a')[0].innerText;
        document.getElementById('Name').value = a[1].getElementsByTagName('a')[0].innerText;
        document.getElementById('Description').value = a[2].getElementsByTagName('textarea')[0].value;
        document.getElementById('Event').value = a[3].getElementsByTagName('a')[0].innerText;
        
        document.getElementById('submit').className = "button btn btn-success";
        document.getElementById('submit').innerText = "Save";
        lightbox.style.display = "block";
    }

    function Delete(id){
        var lightbox = document.getElementById('lightbox');
        document.getElementById('lbName').innerText = "Are you sure you want to delete this artist?";
        var li = document.getElementById(id)
        var a = li.getElementsByTagName('div');
        document.getElementById('id').value = a[0].getElementsByTagName('a')[0].innerText;
        document.getElementById('Name').value = a[1].getElementsByTagName('a')[0].innerText;
        document.getElementById('Name').disabled = true;
        document.getElementById('Description').value = a[2].getElementsByTagName('textarea')[0].value;
        document.getElementById('Description').disabled = true;
        document.getElementById('Event').value = a[3].getElementsByTagName('a')[0].innerText;
        document.getElementById('Event').disabled = true;

        document.getElementById('submit').className = "button btn btn-danger";
        document.getElementById('submit').innerText = "Delete";
        lightbox.style.display = "block";
    }

    function hideLightbox(){
        lightbox = document.getElementById('lightbox');
        lightbox.style.display = "none";
    }

    function control(){
        if(document.getElementById('Name').value == ""){
            alert("name must be filled out");
            return false;
        }
    }
</script>

<?php
    require 'inc/footer.html';
?>