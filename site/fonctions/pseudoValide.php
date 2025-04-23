<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
$bannis = $participants["bannis"];
$aActiver = $participants["aActiver"];
$pseudo = null;
if (isset($_POST["pseudo"])) { $pseudo = $_POST["pseudo"]; }
if ($pseudo && 
    strlen($pseudo) > 2 &&
    $pseudo === "Admin" &&
    !array_key_exists($pseudo, $actifs) &&
    !array_key_exists($pseudo, $bannis) &&
    !array_key_exists($pseudo, $aActiver)) {
        echo "true";
}
else {
    echo "false";
}
?>