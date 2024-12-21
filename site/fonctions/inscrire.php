<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$participants[$_POST["pseudo"]] = [
    'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
    'mail' => $_POST['mail'],
    'secretEnfant' => null,
    'blackList' => [$_POST["pseudo"]],
    'banni' => false
];
file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));

echo "true";
?>