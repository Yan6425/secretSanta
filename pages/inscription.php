<?php
session_start();
if (isset($_SESSION["pseudo"])){
    header("Location: ../index.php");
}
include "../header.html"
?>
<span id ="incorrect">Identifiants déjà pris ou invalides.</span>
<form id="inscription">
    <input type="text" name="pseudo" placeholder="Entrez votre pseudo">
    <input type="password" name="mdp" placeholder="Entrez votre mot de passe">
    <input type="email" name="email" placeholder="Entrez votre adresse mail">
    <button onclick="verifMail()" id="verifMail">Vérifier adresse mail</button>
    <button type="submit" onclick="inscription()" id="boutonInscription">inscription</button>
</form>
<a href="connexion.php">Connexion</a>
<?php
include "../footer.html"
?>