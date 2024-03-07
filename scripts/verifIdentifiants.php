<?php
$participants = json_decode(file_get_contents("../participants.json"), true);
if (isset($_POST["pseudo"]) && isset($_POST["mdp"])         //vérifie que les identifiants sont définis
    && array_key_exists($_POST["pseudo"], $participants)    //vérifie que l'utilisateur existe
    && $participants[$_POST] == $_POST["mdp"]){             //vérifie que le mot de passe est correct
        echo true;
}
else{
    echo false;
}
?>