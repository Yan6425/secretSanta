<?php
session_start();
if (isset($_SESSION["pseudo"])){
    header("Location: ../index.php");
}
include "../header.html"
?>
<span id ="pseudoIncorrect" class="invisible">Pseudo déjà pris ou invalide.<br></span>
<span id ="mdpIncorrect" class="invisible">Mot de passe trop faible.<br></span>
<span id ="mailIncorrect" class="invisible">Adresse mail invalide.<br></span>
<span id ="mailEnvoye" class="invisible">Un mail vous a été envoyé pour finaliser l'inscription.</span>
<p>Entrez un mot de passe différent des autres services que vous utilisez, sécurité de la base de donnée non garantie.</p>
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