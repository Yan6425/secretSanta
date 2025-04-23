<?php
if (isset($_POST["pseudo"]) && $_POST['mdp'] && $_POST['mail']) {
    $participants = json_decode(file_get_contents("../../participants.json"), true);
    $aActiver = $participants["aActiver"];
    $aActiver[$_POST["pseudo"]] = [
        'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
        'mail' => $_POST['mail']
    ];
    $participants["aActiver"] = $aActiver;
    file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
    echo "true";
}
else { echo "false"; }
?>