<?php
session_start();
$parametres = json_decode(file_get_contents("../parametres.json"), true);
if (!isset($_SESSION["pseudo"]) || $parametres["tirageFait"]){
    header("Location: ../index.php");
}
include "../header.html"
?>
<p>Le tirage n'a pas encore commencé, mais en attendant tu peux jouer au jeu du dinosaure de chrome : <a href="https://dino-chrome.com">https://dino-chrome.com</a></p>
<?php
include "../footer.html"
?>