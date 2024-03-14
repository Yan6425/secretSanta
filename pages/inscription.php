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
    <input type="email" name="mail" placeholder="Entrez votre adresse mail">
    <input type="password" name="mdp" placeholder="Entrez votre mot de passe">
    <button type="submit" onclick="inscription()">inscription</button>
</form>
<a href="connexion.php">Connexion</a>
<?php
include "../footer.html"
?>