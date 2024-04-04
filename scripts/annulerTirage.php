<?php
$participants = json_decode(file_get_contents("../participants.json"), true);
foreach ($participants as $nom => $infos) {
    if ($nom != "Admin") {
        $participants[$nom]["secretEnfant"] = null;
    }
}
file_put_contents("../participants.json", json_encode($participants, JSON_PRETTY_PRINT));

$parametres = json_decode(file_get_contents("../parametres.json"), true);
$parametres["tirageFait"] = false;
file_put_contents("../parametres.json", json_encode($parametres, JSON_PRETTY_PRINT));

echo "true";
?>