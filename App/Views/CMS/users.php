<?php
    use App\Config;

    require 'inc/header.php';

    require 'inc/nav.php';

?>
<div class="content" id="users">
    <div class="food_container">
        <div class="title">
            <h1 class="content_center">
                <?php echo ucfirst($params["action"]); ?>
            </h1>
        </div>
        <div class="row food_container">
            <div class="input-group mb-3">
                <input type="text" id="filter" onkeyup="filter()" class="form-control" placeholder="Email, First Name or Last Name" aria-label="Artist" aria-describedby="button-addon">
            </div>
            <div class="lvheader">
                <div><a class="content_horizontal">Email</a></div>
                <div><a class="content_horizontal">First Name</a></div>
                <div><a class="content_horizontal">Last Name</a></div>
                <div><a class="content_horizontal">Role</a></div>
            </div>
                <div class="listview" id="listview"><?php
                    foreach ($users as $user) {
                        echo("<form action='" . Config::URLROOT . "/cms/users' method='post' onsubmit='return Control(" . $user->UserID . ")'>");
                        echo("<input id='id". $user->UserID ."' name='id". $user->UserID ."' type='hidden' value='". $user->UserID ."'>");
                        echo("<div class='lvitem' id='" . $user->UserID . "'><input id='action". $user->UserID ."' name='action". $user->UserID ."' type='hidden'>");
                        echo("<div><a class='content_horizontal'><strong>" . $user->Email . "</strong></a></div>");
                        echo("<div><a class='content_horizontal'>" . $user->FirstName . "</a></div>");
                        echo("<div><a class='content_horizontal'>" . $user->LastName . "</a></div>");
                        echo("<div class='padding'><a class='content_horizontal'>" . $user->Type . "</a></div>");
                        echo("<div class='buttons'>");
                        echo("<button type='button' class='btn btn-secondary float-left' onclick='Edit(" . $user->UserID . ")'><i class='far fa-edit fa-lg'></i>");
                        echo("<button type='submit' value='Submit' class='btn btn-danger float-right' onclick='Delete(" . $user->UserID . ")'><i class='far fa-trash-alt fa-lg'></i>");
                        echo("</div></div></form>");
                    }?>
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
            a = li[i].getElementsByTagName('div')[0].getElementsByTagName('a')[0]; 
            emailValue = a.textContent || a.innerText;
            a = li[i].getElementsByTagName('div')[1].getElementsByTagName('a')[0]; 
            firstNameValue = a.textContent || a.innerText;
            a = li[i].getElementsByTagName('div')[2].getElementsByTagName('a')[0]; 
            lastNameValue = a.textContent || a.innerText;
            if (emailValue.toUpperCase().indexOf(filter) > -1 || firstNameValue.toUpperCase().indexOf(filter) > -1 || lastNameValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }      
        }
    }

    function Edit(id){
        var idEl = document.getElementById(id);
        var div = idEl.getElementsByTagName('div')[3];
        var role = div.getElementsByTagName('a')[0].innerText;
        div.innerHTML = "<select name='Role' class='custom-select' hidden><option value='customer' selected>customer</option><option value='volunteer'>volunteer</option><option value='admin'>admin</option></select>";
        var select = div.getElementsByTagName('select')[0];
        select.hidden = false;
        select.value = role;
        var buttons = idEl.getElementsByTagName('div')[4].getElementsByTagName('button');
        buttons[0].outerHTML = "<button type='submit' value'Submit' class='btn btn-success float-left' onclick='Save(" + id + ")'><i class='fas fa-check fa-lg'></i>";
        buttons[1].outerHTML = "<button type='button' class='btn btn-danger float-right' onclick=\"Cancel(" + id + ", '" + role + "')\"><i class='fas fa-times fa-lg'></i>";
    }

    function Cancel(id, role){
        var idEl = document.getElementById(id);
        var div = idEl.getElementsByTagName('div')[3];
        div.innerHTML = "<a class='content_horizontal'>" + role + "</a>";
        var buttons = idEl.getElementsByTagName('div')[4].getElementsByTagName('button');
        buttons[0].outerHTML = "<button type='button' class='btn btn-secondary float-left' onclick='Edit(" + id + ")'><i class='far fa-edit fa-lg'></i>";
        buttons[1].outerHTML = "<button type='button' class='btn btn-danger float-right' onclick='Delete(" + id + ")'><i class='far fa-trash-alt fa-lg'></i>";
    }

    function Save(id){
        var idEl = document.getElementById(id);
        var input = idEl.getElementsByTagName('input')[0];
        input.value = "Save";
    }

    function Delete(id){
        var idEl = document.getElementById(id);
        var input = idEl.getElementsByTagName('input')[0];
        input.value = "Delete";
    }

    function Control(id){
        var idEl = document.getElementById(id);
        var email = idEl.getElementsByTagName('div')[0].getElementsByTagName('a')[0].innerText;
        var input = idEl.getElementsByTagName('input')[0];
        if (input.value == "Save") {
            return true;
        }
        if (confirm("Are you sure you want to delete " + email + "?")) {
            return true;
        }
        
        return false;
    }
</script>

<?php
    require 'inc/footer.html';
?>