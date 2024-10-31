<?php
$tblMdp = json_decode(file_get_contents("../tblMdp.json"), true);
if (isset($_POST["mdp"]) && 
    strlen($_POST["mdp"]) > 2 &&
    !in_array($_POST["mdp"], $tblMdp)) {
        echo "true";
}
else {
    echo "false";
}
?>