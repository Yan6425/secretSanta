<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
if (password_needs_rehash($participants[$_POST["pseudo"]]["mdp"], PASSWORD_DEFAULT)){
    $participants[$_POST["pseudo"]]["mdp"] = password_hash($participants[$_POST["pseudo"]]["mdp"], PASSWORD_DEFAULT);
}
if (isset($_POST["pseudo"]) && isset($_POST["mdp"])                     //vérifie que les identifiants sont définis
    && array_key_exists($_POST["pseudo"], $participants)                //vérifie que l'utilisateur existe
    && !$participants[$_POST["pseudo"]]["banni"]                        //vérifie que l'utilisateur n'est pas banni
    && password_verify($_POST["mdp"], $participants[$_POST["pseudo"]]["mdp"])){        //vérifie que le mot de passe est correct
        session_start();
        $_SESSION["pseudo"] = $_POST["pseudo"];
        echo "true";
}
else{
    echo "false";
}
?>