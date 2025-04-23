<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
if  ((isset($_POST["pseudo"]))                                           //vérifie que les identifiants sont définis
    && array_key_exists($_POST["pseudo"], $actifs)){               //vérifie que l'utilisateur existe
        unset($actifs[$_POST["pseudo"]]);
        $participants["actifs"] = $actifs;
        file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
        echo "true";
}
else{
    echo "false";
}
?>