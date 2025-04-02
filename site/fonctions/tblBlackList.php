<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
if (isset($_POST["pseudo"])                                         //vérifie que les identifiants sont définis
    && array_key_exists($_POST["pseudo"], $participants)){          //vérifie que l'utilisateur existe
        foreach ($participants as $pseudo => $infos) {
            if ($pseudo != "Admin" && $pseudo != $_POST["pseudo"] && !$infos["banni"]) : ?>
                <tr>
                    <td><?= htmlspecialchars($pseudo) ?></td>
                    <td><?= htmlspecialchars($infos['mail']) ?></td>
                    <td><button onclick="modifBL('<?= $_POST['pseudo'] ?>', '<?= $pseudo ?>')" id="modifBL<?= $pseudo ?>">
                        <?= in_array($pseudo, $participants[$_POST["pseudo"]]["blackList"]) ? 'Enlever' : 'Ajouter' ?>
                    </button></td>
                </tr>
            <?php endif;
        }
}
?>