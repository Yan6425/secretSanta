<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
do {
    $tblPseudos = array_keys($participants);
    $tblPseudos = array_values(array_diff($tblPseudos, ["Admin"]));
    foreach($participants as $pseudo => $infos) {
        if ($infos["banni"]) {
            $tblPseudos = array_values(array_diff($tblPseudos, [$pseudo]));
        }
    }
    $reessayer = false;
    foreach ($tblPseudos as $pseudo) {
        if (empty(array_diff($tblPseudos, $participants[$pseudo]["blackList"]))){
            // il ne reste plus que des personnes blacklist pour cet utilisateur, il faut reessayer
            $reessayer = true;
            break;
        }
        do {
            $i = random_int(0, count($tblPseudos)-1);
        } while (in_array($tblPseudos[$i], $participants[$pseudo]["blackList"]));
        $participants[$pseudo]["secretEnfant"] = $tblPseudos[$i];
        array_splice($tblPseudos, $i, 1);
    }
} while ($reessayer);
file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));

$parametres = json_decode(file_get_contents("../../parametres.json"), true);
$parametres["tirageFait"] = true;
file_put_contents("../../parametres.json", json_encode($parametres, JSON_PRETTY_PRINT));

echo "true";
?>