<?php
$participants = json_decode(file_get_contents("../participants.json"), true);
do {
    $tblNoms = array_keys($participants);
    array_splice($tblNoms, 0, 1);
    $boucleInfinie = false;
    foreach ($participants as $nom => $infos) {
        if ($nom != "Admin") {
            if (empty(array_diff($tblNoms, $infos["blackList"]))){
                $boucleInfinie = true;
                break;
            }
            do {
                $i = random_int(0, count($tblNoms)-1);
            } while (in_array($tblNoms[$i], $infos["blackList"]));
            $participants[$nom]["secretEnfant"] = $tblNoms[$i];
            array_splice($tblNoms, $i, 1);
        }
    }
} while ($boucleInfinie);
file_put_contents("../participants.json", json_encode($participants, JSON_PRETTY_PRINT));

$parametres = json_decode(file_get_contents("../parametres.json"), true);
$parametres["tirageFait"] = true;
file_put_contents("../parametres.json", json_encode($parametres, JSON_PRETTY_PRINT));

echo "true";
?>