<?php

    use App\Config;

    require 'inc/header.php';
    require 'inc/nav.php';

?>

<div class="content" id="events">
    <div class="food_container">
        <div class="title">
            <h1 class="content_center" id="Title">
                <?php echo ucfirst($params["event"]); ?>
            </h1>
        </div>
    
        <div class="row">
            <div class="col-2">
                <div class="filter">
                    <h2 class="text-center">Filter</h2>
                    <hr>
                    <div class="input-group mb-3">
                        <input type="text" id="filterArtist" onkeyup="filter()" class="form-control" placeholder="Restaurant" aria-label="Restaurant" aria-describedby="button-addon">
                    </div>
                    <hr>
                    <div class="input-group mb-3">
                        <input type="text" id="filterDay" onkeyup="filter()" class="form-control" placeholder="Day" aria-label="Day" aria-describedby="button-addon">
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="listview" id="listview"><?php
                    foreach ($restaurants as $restaurant) {
                        echo("<div class='listitem' id='" . $restaurant->RestaurantID . "'><div class='litopfood'><div class='litoptext'>");
                        echo $restaurant->Name;
                        echo("</div><div class='litoptext'>");
                        echo $restaurant->Address;
                        echo("</div><div class='litoptext'>");
                        echo $restaurant->CityAndCountry;
                        echo("</div></div>");
                        echo("<div class='libottomfood'><div class='libottomtext'>First session:</br>");
                        echo $restaurant->FirstSession;
                        echo("</div><div class='libottomtext'>Sessions:</br>");
                        echo $restaurant->TotalSessions;
                        echo("</div><div class='libottomtext'>Duration:</br>");
                        echo $restaurant->SessionDuration . " hour";
                        echo("</div><div class='libottomtext'>Price:</br>");
                        echo("€ " . number_format((float)$restaurant->Price, 2, ',', ''));
                        echo("</div><div class='libottomtext'>Seats:</br>");
                        echo $restaurant->Seats;
                        echo("</div><div class='libottomtext'><button type='button' class='btn btn-secondary float-left' onclick='Edit(" . $restaurant->RestaurantID . ")'><i class='far fa-edit fa-lg'></i>");
                        echo("</div></div></div>");
                    }?>
                </div>
            </div>
            <div class="lightbox" id="lightbox">
                <div class="lbcontent">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="lbName"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideLightbox()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo Config::URLROOT; ?>/cms/events/<?php echo $params["event"]; ?>" method="post">
                        <input id="id" name="id" type="hidden">
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                            <input type="text" name="Name" id="Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Address" class="col-sm-2 col-form-label">Address:</label>
                            <div class="col-sm-10">
                            <input type="text" name="Address" id="Address" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="City" class="col-sm-2 col-form-label">City and country:</label>
                            <div class="col-sm-10">
                            <input type="text" name="City" id="City" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firstSession" class="col-sm-2 col-form-label">First Session:</label>
                            <div class="col-sm-10">
                                <select name="firstSession" class="custom-select" id="firstSession">
                                    <option value="16:30:00">16:30:00</option>
                                    <option value="17:00:00">17:00:00</option>
                                    <option value="17:30:00">17:30:00</option>    
                                    <option value="18:00:00">18:00:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Sessions" class="col-sm-2 col-form-label">Total Sessions:</label>
                            <div class="col-sm-10">
                            <input type="number" name="Sessions" id="Sessions" min="1" max="5" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="Duration" class="col-sm-2 col-form-label">Duration:</label>
                            <div class="col-sm-10">
                                <select name="Duration" class="custom-select" id="Duration">
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>    
                                    <option value="2.5">2.5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Price" class="col-sm-2 col-form-label">Price:</label>
                            <div class="col-sm-10">
                            <input type="price" name="Price" id="Price" min="1" max="100" step="0,5" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Seats" class="col-sm-2 col-form-label">Seats:</label>
                            <div class="col-sm-10">
                            <input type="number" name="Seats" id="Seats" min="1" max="100" class="form-control">
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
    var StartTime, EndTime, NewStartTime, NewEndTime;

    function filter(){
        var input, filterArtist, filterDay, lv, li, i, divArtist, divDay, txtValueArtist, txtValueDay;
        
        input = document.getElementById('filterArtist');
        filterArtist = input.value.toUpperCase();

        input = document.getElementById('filterDay');
        filterDay = input.value.toUpperCase();

        lv = document.getElementById('listview');
        li = lv.getElementsByClassName('listitem');

        for (i = 0; i < li.length; i++) {
            divArtist = li[i].getElementsByTagName('div')[0].getElementsByTagName('div')[2]; 
            txtValueArtist = divArtist.textContent || divArtist.innerText;

            divDay = li[i].getElementsByTagName('div')[0].getElementsByTagName('div')[0]; 
            txtValueDay = divDay.textContent || divDay.innerText;

            if (txtValueArtist.toUpperCase().indexOf(filterArtist) > -1 && txtValueDay.toUpperCase().indexOf(filterDay) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }      
        }
    }

    function Edit(id){
        var lightbox = document.getElementById('lightbox');
        document.getElementById('lbName').innerText = "Edit restaurant";
        var div = document.getElementById(id)
        var top = div.getElementsByTagName('div')[0];
        var bottom = div.getElementsByTagName('div')[4];

        document.getElementById('id').value = id;
        document.getElementById('Name').value = top.getElementsByTagName('div')[0].innerText;
        document.getElementById('Address').value = top.getElementsByTagName('div')[1].innerText;
        document.getElementById('City').value = top.getElementsByTagName('div')[2].innerText;
        document.getElementById('firstSession').value = bottom.getElementsByTagName('div')[0].innerHTML.split("<br>")[1];
        document.getElementById('Sessions').value = bottom.getElementsByTagName('div')[1].innerHTML.split("<br>")[1];
        document.getElementById('Duration').value = bottom.getElementsByTagName('div')[2].innerHTML.split("<br>")[1].split(" ")[0];
        document.getElementById('Price').value = bottom.getElementsByTagName('div')[3].innerHTML.split("<br>")[1].split(" ")[1];
        document.getElementById('Seats').value = bottom.getElementsByTagName('div')[4].innerHTML.split("<br>")[1];

        document.getElementById('submit').className = "button btn btn-success";
        document.getElementById('submit').innerText = "Save";
        lightbox.style.display = "block";
    }

    function hideLightbox(){
        lightbox = document.getElementById('lightbox');
        lightbox.style.display = "none";
    }

    function arraysEqual(arr1, arr2) {
        if(arr1.length !== arr2.length){
            return false;
        }
        for(var i = arr1.length; i--;) {
            if(arr1[i] !== arr2[i]){
                return false;
            }
        }

        return true;
    }
</script>

<?php
    require 'inc/footer.html';
?>
