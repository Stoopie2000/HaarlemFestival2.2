<?php

    use App\Config;

    require 'inc/header.php';
    require 'inc/nav.php';

?>

<div class="content" id="events">
    <div class="container">
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
                        <input type="text" id="filterArtist" onkeyup="filter()" class="form-control" placeholder="Artist" aria-label="Artist" aria-describedby="button-addon">
                    </div>
                    <hr>
                    <div class="input-group mb-3">
                        <input type="text" id="filterDay" onkeyup="filter()" class="form-control" placeholder="Day" aria-label="Day" aria-describedby="button-addon">
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="listview" id="listview"><?php
                    foreach ($concerts as $concert) {
                        echo("<div class='listitem' id='" . $concert->ConcertID . "'><div class='litop'><div class='litoptext'>");
                        echo date_format($concert->Date, "l");
                        echo("</div><div class='litoptext'>");
                        echo date_format($concert->Date, "d F");
                        echo("</div><div class='litoptext'>");
                        for ($i=0; $i < count($concert->Artists); $i++) { 
                            echo $concert->Artists[$i]->Name;
                            if ($i != (count($concert->Artists) - 1)) {
                                echo ", ";
                            }
                        }
                        echo("</div><div class='litoptext'>");
                        echo(date_format($concert->StartTime, "G:i") . " - " . date_format($concert->EndTime, "G:i"));
                        echo("</div></div><div class='libottom'><div class='libottomtext'>Location:</br>");
                        echo $concert->Venue->Name;
                        if ($params["event"] == "jazz") {
                            echo("</div><div class='libottomtext'>Hall:</br>");
                            echo $concert->Venue->Hall;
                        } else {
                            echo("</div><div class='libottomtext'>Adress:</br>");
                            echo $concert->Venue->Address;
                        }
                        echo("</div><div class='libottomtext'>Seats:</br>");
                        echo $concert->Venue->SeatingCapacity;
                        echo("</div><div class='libottomtext'>Price:</br>");
                        echo("€ " . number_format((float)$concert->Price, 2, ',', ''));
                        echo("</div><div class='libottomtext'><button type='button' class='btn btn-secondary float-left' onclick='Edit(" . $concert->ConcertID . ")'><i class='far fa-edit fa-lg'></i>");
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
                            <label for="Date" class="col-sm-2 col-form-label">Date:</label>
                            <div class="col-sm-10">
                                <select name="Date" class="custom-select" id="Date">
                                    <?php 
                                        foreach ($dates as $date) {
                                            echo "<option value='" . $date->Day . " " . date_format($date->Date, "d F") . "'>" . $date->Day . " " . date_format($date->Date, "d F") . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Artists" class="col-sm-2 col-form-label">Artists:</label>
                            <div class="col-sm-10">
                                <select name="Artist1" class="custom-select" id="Artist1">
                                    <?php 
                                        foreach ($artists as $artist) {
                                            echo "<option value='" . $artist->Name . "'>" . $artist->Name . "</option>";
                                        }
                                    ?>
                                </select>
                                <select name="Artist2" class="custom-select" id="Artist2">
                                    <option></option>
                                    <?php 
                                        foreach ($artists as $artist) {
                                            echo "<option value='" . $artist->Name . "'>" . $artist->Name . "</option>";
                                        }
                                    ?>
                                </select>
                                <select name="Artist3" class="custom-select" id="Artist3">
                                    <option></option>
                                    <?php 
                                        foreach ($artists as $artist) {
                                            echo "<option value='" . $artist->Name . "'>" . $artist->Name . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Time" class="col-sm-2 col-form-label">Time:</label>
                            <div class="col-sm-4">
                                <select name="BeginTime" class="custom-select" id="StartTime" onchange="CheckTime()">
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>    
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                </select>
                            </div>
                            <div class="col-sm-2">-</div>
                            <div class="col-sm-4">
                            <select name="EndTime" class="custom-select" id="EndTime" onchange="CheckTime()">
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>    
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>        
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                    <option value="0:00">0:00</option>
                                    <option value="0:30">0:30</option>
                                    <option value="1:00">1:00</option>
                                    <option value="1:30">1:30</option>
                                    <option value="2:00">2:00</option>
                                    <option value="2:30">2:30</option>
                                    <option value="3:00">3:00</option>
                                    <option value="3:30">3:30</option>
                                    <option value="4:00">4:00</option>
                                    <option value="4:30">4:30</option>
                                    <option value="5:00">5:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Location" class="col-sm-2 col-form-label">Location:</label>
                            <div class="col-sm-10">
                            <select name="Location" class="custom-select" id="Location">
                                    <?php 
                                        foreach ($locations as $location) {
                                            if ($params["event"] == "jazz") {
                                                echo "<option value='" . $location->Hall . "'>" . $location->Name . ": " . $location->Hall . "</option>";
                                            } else {
                                                echo "<option value='" . $location->Name . "'>" . $location->Name . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Price" class="col-sm-2 col-form-label">Price:</label>
                            <div class="col-sm-10">
                                <input type="text" name="Price" id="Price" class="form-control" aria-label="euro amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                    <span class="input-group-text">0.00</span>
                                </div>
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
        document.getElementById('lbName').innerText = "Edit concert";
        var div = document.getElementById(id)
        var top = div.getElementsByTagName('div')[0];
        var bottom = div.getElementsByTagName('div')[5];
        var artists = top.getElementsByTagName('div')[2].innerText.split(", ");
        var time = top.getElementsByTagName('div')[3].innerText.split(" - ");
        StartTime = time[0];
        EndTime = time[1];

        document.getElementById('id').value = id;
        document.getElementById('Date').value = top.getElementsByTagName('div')[0].innerText.concat(" ", top.getElementsByTagName('div')[1].innerText);
        document.getElementById('Artist1').value = artists[0];
        document.getElementById('Artist2').value = artists[1];
        document.getElementById('Artist3').value = artists[2];
        document.getElementById('StartTime').value = StartTime;
        document.getElementById('EndTime').value = EndTime;
        if(document.getElementById('Title').innerText == "Jazz"){
            var text = bottom.getElementsByTagName('div')[1].innerHTML.split("<br>");
            document.getElementById('Location').value = bottom.getElementsByTagName('div')[1].innerHTML.split("<br>")[1];
        } else {
            document.getElementById('Location').value = bottom.getElementsByTagName('div')[0].innerHTML.split("<br>")[1];
        }
        document.getElementById('Price').value = bottom.getElementsByTagName('div')[3].innerText.split(" ")[1];

        document.getElementById('submit').className = "button btn btn-success";
        document.getElementById('submit').innerText = "Save";
        lightbox.style.display = "block";
    }

    function hideLightbox(){
        lightbox = document.getElementById('lightbox');
        lightbox.style.display = "none";
    }

    function CheckTime(){
        NewStartTime = document.getElementById('StartTime').value;
        NewEndTime = document.getElementById('EndTime').value;
        var Hour, Minute;
        StartTime = StartTime.split(":");
        StartTime[0] = parseInt(StartTime[0]);
        StartTime[1] = parseInt(StartTime[1]);
        NewStartTime = NewStartTime.split(":");
        NewStartTime[0] = parseInt(NewStartTime[0]);
        NewStartTime[1] = parseInt(NewStartTime[1]);
        EndTime = EndTime.split(":");
        EndTime[0] = parseInt(EndTime[0]);
        EndTime[1] = parseInt(EndTime[1]);
        NewEndTime = NewEndTime.split(":");
        NewEndTime[0] = parseInt(NewEndTime[0]);
        NewEndTime[1] = parseInt(NewEndTime[1]);
        

        if (!arraysEqual(StartTime, NewStartTime)) {
            if (EndTime[0] < StartTime[0]) {
                EndTime[0] = EndTime[0] + 24;
            }
            Hour = EndTime[0] - StartTime[0];
            if (EndTime[1] > StartTime[1]) {
                Minute = 30;
            } else if (EndTime[1] < StartTime[1]) {
                Minute = 30;
                Hour = Hour - 1;
            } else{
                Minute = 0;
            }

            NewEndTime[0] = NewStartTime[0] + Hour;
            NewEndTime[1] = NewStartTime[1] + Minute;
            if (NewEndTime[1] == 60) {
                NewEndTime[1] = NewEndTime[1] - 60;
                NewEndTime[0] = NewEndTime[0] + 1;
            }
            if (NewEndTime[0] >= 24) {
                NewEndTime[0] = NewEndTime[0] - 24;
            }
            
            NewEndTime[1] = NewEndTime[1].toString();
            if (NewEndTime[1].length == 1) {
                NewEndTime[1] = "0" + NewEndTime[1];
            }
            NewEndTime = NewEndTime[0].toString().concat(":", NewEndTime[1]);
            document.getElementById('EndTime').value = NewEndTime;
        }
        StartTime = document.getElementById('StartTime').value;
        EndTime = document.getElementById('EndTime').value
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
