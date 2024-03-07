<?php
session_start();
if (isset($_SESSION["pseudo"])){
    header("Location: ../index.php");
}
include "../header.html"
?>
<a id="mdpOublie">Mot de passe oublie</a>
<button id="verifIdentifiants">Connexion</button>
<?php
include "../footer.html"
?>