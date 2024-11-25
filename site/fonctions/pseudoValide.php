<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
if (isset($_POST["pseudo"]) && 
    strlen($_POST["pseudo"]) > 2 &&
    !array_key_exists($_POST["pseudo"], $participants)) {
        echo "true";
}
else {
    echo "false";
}
?>