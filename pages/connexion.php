<?php
session_start();
$parametres = json_decode(file_get_contents("../parametres.json"), true);
if (isset($_SESSION["pseudo"])){
    if ($parametres["tirageFait"]){
        header("Location: devoiler.php");
    }
    else {
        header("Location: enAttente.php");
    }
}
include "../header.html"
?>
<a id="mdpOublie">Mot de passe oublie</a>
<button id="verifIdentifiants">Connexion</button>
<?php
include "../footer.html"
?>