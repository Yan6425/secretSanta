<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
$aActiver = $participants["aActiver"];
$reussite = false;
if (isset($_POST["pseudo"]) && isset($aActiver[$_POST["pseudo"]])){
    $actifs[$_POST["pseudo"]] = $aActiver[$_POST["pseudo"]];
    unset($aActiver[$_POST["pseudo"]]);
    $actifs[$_POST["pseudo"]]["secretEnfant"] = null;
    $actifs[$_POST["pseudo"]]["blackList"] = [$_POST["pseudo"]];
    $participants["actifs"] = $actifs;
    $participants["aActiver"] = $aActiver;
    file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
    $reussite = true;
}
echo $reussite ? "true" : "false";
?>