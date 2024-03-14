<?php
$participants = json_decode(file_get_contents("../participants.json"), true);
if (isset($_POST["pseudo"]) && isset($_POST["mdp"]) && isset($_POST["mail"])       //vérifie que les identifiants sont définis
    && !array_key_exists($_POST["pseudo"], $participants)){                         //vérifie que l'utilisateur n'existe pas déjà
        $emailUnique = true;
        foreach($participants as $pseudo => $donnees) {
            $emailUnique = $donnees["mail"] != $_POST["mail"];
        }
        echo "$emailUnique";
}
else{
    echo "false";
}
?>