<?php
if (isset($flash)){
    echo "<div class=\"container fixed-bottom position-absolute\">
    <div class=\"row\">
        <div class=\"col-6 offset-3\">";
    foreach ($flash as $message){
        switch ($message["type"]){
            case "success":     echo ("
                <div class=\"alert alert-success alert-dismissible fade show \" role=\"alert\">");
                echo $message["body"];
                break;
            case "info":         echo ("
                <div class=\"alert alert-info alert-dismissible fade show \" role=\"alert\">");
                echo $message["body"];
                break;
            case "warning":         echo ("
                <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\">");
                echo $message["body"];
                break;
        }

        echo ("
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            ");
    }

    echo "        </div>
    </div>
</div>";
}

?>