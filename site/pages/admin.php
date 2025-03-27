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
                <td><button onclick="banDeban('<?= $pseudo ?>')" id="ban<?= $pseudo ?>"><?= $infos['banni'] ? 'Débannir' : 'Bannir' ?></button></td>
                <td><button onclick="ouvrirBL('<?= $pseudo ?>')">Blacklist</button></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
<div id="fenetreBL" class="invisible">
    <div id="contenuBL">
        <span id="boutonFermerBL" onclick="fermerBL()">&times;</span>
    </div>
</div>
<script type="text/javascript" src="../admin.js"></script>
<style type="text/css" src="../fenetreBL.css"></style>
<?php
include "../footer.html"
?>