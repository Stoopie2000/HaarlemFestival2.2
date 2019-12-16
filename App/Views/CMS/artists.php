<?php
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
                    echo("<div class='lvitem' id='lvitem'><div><a class='content_horizontal'><strong>" . $artist->ArtistID . "</strong></a></div>");
                    echo("<div><a class='content_horizontal'>" . $artist->Name . "</a></div>");
                    echo("<div><textarea readonly class='content_horizontal'>" . $artist->Description . "</textarea></div>");
                    echo("<div><a class='content_horizontal'>" . $artist->Event . "</a></div>");
                    echo("<div class='buttons'>");
                    echo("<button type='button' class='edit' onclick='e'")
                    echo("</div></div>");
                }?></div>
            <div>
                <button type="button" class="button btn btn-success" onclick="showLightbox('Create new artist')">Add artist</button>
            </div>
            <div class="lightbox" id="lightbox">
                <div class="lbcontent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lbName"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideLightbox()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#">
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Name:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="Name" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Description:</label>
                            <div class="col-sm-10">
                                <textarea id="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Event:</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="Event">
                                    <option selected>Jazz</option>
                                    <option value="1">Dance</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                        <button type="button" class="button btn btn-success" onclick="">save</button>
                        <button type="button" class="button btn btn-success" onclick="">save</button>
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

    function Create(){
        var lightbox = document.getElementById('lightbox');
        document.getElementById('lbName').innerText = "create new artist";
        document.getElementById('Name').innerText = "";
        document.getElementById('Description').innerText = "";
        lightbox.style.display = "block";
    }

    function Edit(id){
        var lightbox = document.getElementById('lightbox');
        document.getElementById('lbName').innerText = "edit artist";
        lightbox.style.display = "block";
    }

    function hideLightbox(){
        lightbox = document.getElementById('lightbox');
        lightbox.style.display = "none";
    }
</script>

<?php
    require 'inc/footer.html';
?>