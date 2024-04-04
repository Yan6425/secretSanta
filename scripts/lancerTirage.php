<?php
$participants = json_decode(file_get_contents("../participants.json"), true);
$tblNoms = array_keys($participants);
foreach ($participants as $nom => $infos) {
    if ($nom != "Admin") {
        do {
            $i = random_int(1, count($tblNoms)-1);
        } while (in_array($tblNoms[$i], $infos["blackList"]));
        $participants[$nom]["secretEnfant"] = $tblNoms[$i];
        array_splice($tblNoms, $i, 1);
    }
}
file_put_contents("../participants.json", json_encode($participants, JSON_PRETTY_PRINT));

$parametres = json_decode(file_get_contents("../parametres.json"), true);
$parametres["tirageFait"] = true;
file_put_contents("../parametres.json", json_encode($parametres, JSON_PRETTY_PRINT));

echo "true";
?>