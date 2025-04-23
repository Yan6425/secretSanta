<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$reussite = false;

if (isset($_POST["pseudo"]) && isset($_POST["mdp"])) {
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];

    if ($pseudo === "Admin") {
        $utilisateur = $participants["Admin"];
    } else if (isset($participants["actifs"][$pseudo])) {
        $utilisateur = $participants["actifs"][$pseudo];
    } else {
        $utilisateur = null;
    }

    if ($utilisateur) {
        if (password_needs_rehash($utilisateur["mdp"], PASSWORD_DEFAULT)) {
            $utilisateur["mdp"] = password_hash($utilisateur["mdp"], PASSWORD_DEFAULT);
            if ($pseudo === "Admin") {
                $participants["Admin"] = $utilisateur;
            } else {
                $participants["actifs"][$pseudo] = $utilisateur;
            }
            file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
        }

        if (password_verify($mdp, $utilisateur["mdp"])) {
            session_start();
            $_SESSION["pseudo"] = $pseudo;
            $reussite = true;
        }
    }
}

echo $reussite ? "true" : "false";
?>
