<?php
session_start();
if (!isset($_SESSION["pseudo"]) || $_SESSION["pseudo"] != "Admin"){
    header("Location: ../index.php");
}
$participants = json_decode(file_get_contents('../../participants.json'), true);

include "../header.html"
?>
<button onclick="lancerTirage()">Lancer tirage</button>
<button onclick="annulerTirage()">Annuler tirage</button>
<table>
    <tr>
        <th>Pseudo</th>
        <th>Email</th>
        <th>Secret enfant</th>
    </tr>
    <?php foreach ($participants as $pseudo => $infos): ?>
        <tr>
            <td><?= htmlspecialchars($pseudo) ?></td>
            <td><?= htmlspecialchars($infos['mail']) ?></td>
            <?php if ($pseudo != 'Admin'): ?>
                <td><?= htmlspecialchars($infos['secretEnfant']) ?></td>
                <td><button onclick="banDeban('<?= $pseudo ?>')"><?= $infos['banni'] ? 'Débannir' : 'Bannir' ?></button></td>
                <td><button>Blacklist</button></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
<script type="text/javascript" src="../admin.js"></script>
<?php
include "../footer.html"
?>