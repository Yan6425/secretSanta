<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
$bannis = $participants["bannis"];
foreach ($actifs as $pseudo => $infos) {
    $actifs[$pseudo]["secretEnfant"] = null;
}
foreach ($bannis as $pseudo => $infos) {
    $bannis[$pseudo]["secretEnfant"] = null;
}
$participants["actifs"] = $actifs;
$participants["bannis"] = $bannis;
file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));

$parametres = json_decode(file_get_contents("../../parametres.json"), true);
$parametres["tirageFait"] = false;
file_put_contents("../../parametres.json", json_encode($parametres, JSON_PRETTY_PRINT));

echo "true";
?>