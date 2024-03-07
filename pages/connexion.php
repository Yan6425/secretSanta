<?php
session_start();
if (isset($_SESSION["pseudo"])){
    header("Location: ../index.php");
}
include "../header.html"
?>
<span id ="incorrect">Identifiants incorrects.</span>
<form id="connexion">
    <input type="text" name="pseudo" placeholder="Entrez votre pseudo">
    <input type="password" name="mdp" placeholder="Entrez votre mot de passe">
    <button type="submit" onclick="connexion()">Connexion</button>
</form>
<a href="mdpOublie.php">Mot de passe oublie</a>
<a href="inscription.php">inscription</a>
<?php
include "../footer.html"
?>