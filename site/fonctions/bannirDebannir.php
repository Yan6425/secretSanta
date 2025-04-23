<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
$bannis = $participants["bannis"];
$reussite = false;
if (isset($_POST["pseudo"])){
    if (isset($actifs[$_POST["pseudo"]])) {
        $bannis[$_POST["pseudo"]] = $actifs[$_POST["pseudo"]];
        unset($actifs[$_POST["pseudo"]]);
        $reussite = true;
    }
    else if (isset($bannis[$_POST["pseudo"]])) {
        $actifs[$_POST["pseudo"]] = $bannis[$_POST["pseudo"]];
        unset($bannis[$_POST["pseudo"]]);
        $reussite = true;
    }
    if ($reussite) {
        $participants["actifs"] = $actifs;
        $participants["bannis"] = $bannis;
        file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
    }
}
echo $reussite ? "true" : "false";
?>