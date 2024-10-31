<?php
session_start();
$parametres = json_decode(file_get_contents("../parametres.json"), true);
if (!isset($_SESSION["pseudo"]) || !$parametres["tirageFait"]){
    header("Location: ../index.php");
}
$participants = json_decode(file_get_contents("../participants.json"), true);
if (!isset($participants[$_SESSION["pseudo"]]["secretEnfant"])) {
    header("Location: erreur.php");
}
include "../header.html"
?>
<p><?php echo $_SESSION["pseudo"], " tu es le secret Santa de ", $participants[$_SESSION["pseudo"]]["secretEnfant"] ?>
<p>Gâte le bien !</p>
<?php
include "../footer.html"
?>