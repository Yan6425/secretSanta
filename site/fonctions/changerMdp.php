<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
if (isset($_POST["pseudo"]) && isset($_POST["mdp"]) &&              //vérifie que les identifiants sont définis
    isset($actifs[$_POST["pseudo"]])){                              //vérifie que l'utilisateur existe
        $actifs[$_POST["pseudo"]]["mdp"] = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
        $participants["actifs"] = $actifs;
        file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
        echo "true";
}
else{
    echo "false";
}
?>