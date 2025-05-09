<?php
session_start();
if (!isset($_SESSION["pseudo"]) || $_SESSION["pseudo"] != "Admin"){
    header("Location: ../index.php");
}
$participants = json_decode(file_get_contents('../../participants.json'), true);
$admin = $participants["Admin"];
$actifs = $participants["actifs"];
$bannis = $participants["bannis"];
$aActiver = $participants["aActiver"];

include "../header.html"
?>
<button onclick="boutonLancerTirage()">Lancer tirage</button>
<button onclick="boutonAnnulerTirage()">Annuler tirage</button>
<button onclick="ouvrirFenetreInscrire()">Inscrire</button>
<table>
    <tr>
        <th>Pseudo</th>
        <th>Email</th>
        <th>Secret enfant</th>
    </tr>
    <tr>
        <td>Admin</td>
        <td><?= htmlspecialchars($admin['mail']) ?></td>
    </tr>
    <?php foreach ($actifs as $pseudo => $infos): ?>
        <tr>
            <td><?= htmlspecialchars($pseudo) ?></td>
            <td><?= htmlspecialchars($infos['mail']) ?></td>
            <td><?= htmlspecialchars($infos['secretEnfant']) ?></td>
            <td><button onclick="banDeban('<?= $pseudo ?>')">Bannir</button></td>
            <td><button onclick="ouvrirBL('<?= $pseudo ?>')">Blacklist</button></td>
            <td><button onclick="fenetreMdp('<?= $pseudo ?>')">Changer mdp</button></td>
            <td><button onclick="fenetreSupprimer('<?= $pseudo ?>')">Supprimer</button></td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($aActiver as $pseudo => $infos): ?>
        <tr>
            <td><?= htmlspecialchars($pseudo) ?></td>
            <td><?= htmlspecialchars($infos['mail']) ?></td>
            <td></td>
            <td><button onclick="activer('<?= $pseudo ?>')">Activer</button></td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($bannis as $pseudo => $infos): ?>
        <tr>
            <td><?= htmlspecialchars($pseudo) ?></td>
            <td><?= htmlspecialchars($infos['mail']) ?></td>
            <td><?= htmlspecialchars($infos['secretEnfant']) ?></td>
            <td><button onclick="banDeban('<?= $pseudo ?>')">Débannir</button></td>
        </tr>
    <?php endforeach; ?>
</table>
<div id="fenetreInscrire" class="invisible">
    <div id="contenuInscrire" class="contenu">
        <div id="titreInscrire" class="titre">Inscription participant</div>
        <span class="boutonFermer" onclick="fermerFenetre('fenetreInscrire')">&times;</span>
        <form id="formInscrire">
            <label>Pseudo</label>
            <input type="text" name="pseudo">
            <br>
            <label>Mot de passe</label>
            <input type="password" name="mdp">
            <br>
            <label>Email</label>
            <input type="email" name="mail">
            <br>
            <button type="submit" onclick="formInscrire()">Confirmer</button>
        </form>
    </div>
</div>
<div id="fenetreBL" class="invisible">
    <div id="contenuBL" class="contenu">
        <div id="titreBL" class="titre"></div>
        <span class="boutonFermer" onclick="fermerFenetre('fenetreBL')">&times;</span>
        <table id="tblBlackList"></table>
    </div>
</div>
<div id="fenetreMdp" class="invisible">
    <div id="contenuMdp" class="contenu">
        <div id="titreMdp" class="titre"></div>
        <span class="boutonFermer" onclick="fermerFenetre('fenetreMdp')">&times;</span>
        <form id="formMdp">
            <label>Nouveau mot de passe</label>
            <input type="password" name="mdp">
            <br>
            <button id="confirmerMdp" type="submit">Confirmer</button>
        </form>
    </div>
</div>
<div id="fenetreSupprimer" class="invisible">
    <div id="contenuSupprimer" class="contenu">
        <div id="titreSupprimer" class="titre"></div>
        <button onclick="fermerFenetre('fenetreSupprimer')">Non</button>
        <button id="confirmerSupprimer">Oui</button>
    </div>
</div>
<script type="text/javascript" src="../admin.js"></script>
<style type="text/css" src="../fenetreBL.css"></style>
<?php
include "../footer.html"
?>