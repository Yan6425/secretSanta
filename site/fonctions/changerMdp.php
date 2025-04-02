<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
if  ((isset($_POST["pseudo"]))                                           //vérifie que les identifiants sont définis
    && array_key_exists($_POST["pseudo"], $participants)){               //vérifie que l'utilisateur existe
        $participants[$_POST["pseudo"]]["mdp"] = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
        file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
        echo "true";
}
else{
    echo "false";
}
?>