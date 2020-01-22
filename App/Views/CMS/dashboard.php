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
        <div class="row container">
            <div class="input-group mb-3">
                <input type="text" id="filter" onkeyup="filter()" class="form-control" placeholder="Artist" aria-label="Artist" aria-describedby="button-addon">
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
                                    <option value="jazz" selected>Jazz</option>
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
</script>

<?php
    require 'inc/footer.html';
?>