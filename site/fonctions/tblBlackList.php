<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
if (isset($_POST["pseudo"])                                         //vérifie que les identifiants sont définis
    && isset($actifs[$_POST["pseudo"]])){                     //vérifie que l'utilisateur existe
        foreach ($actifs as $pseudo => $infos) {
            if ($pseudo != $_POST["pseudo"]) : ?>
                <tr>
                    <td><?= htmlspecialchars($pseudo) ?></td>
                    <td><?= htmlspecialchars($infos['mail']) ?></td>
                    <td><button onclick="modifBL('<?= $_POST['pseudo'] ?>', '<?= $pseudo ?>')" id="modifBL<?= $pseudo ?>">
                        <?= in_array($pseudo, $actifs[$_POST["pseudo"]]["blackList"]) ? 'Enlever' : 'Ajouter' ?>
                    </button></td>
                </tr>
            <?php endif;
        }
}
else {
    echo "Participant non trouvé.";
}
?>