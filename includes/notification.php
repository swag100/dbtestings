<?php
    //STATUS POPUP

    $formState = $_SESSION["FORMSTATE"];
    $formStateMsg = $_SESSION["FORMSTATE_MSG"];

    $prettyClass = "\"succeedNotif\"";
    if($formState == "FAILED"){
        $prettyClass = "\"failNotif\"";
    }
    
    if($formState == "FAILURE" || $formState == "SUCCESS"){
        echo "
            <div class=\"NOTIF NOTIF_$formState\">
                <span><b>$formState: </b>$formStateMsg</span>
                <button onclick=\"this.parentElement.remove();\">close</button>
            </div>
        ";
        unset($_SESSION["FORMSTATE"]);
        unset($_SESSION["FORMSTATE_MSG"]);
    }
?>