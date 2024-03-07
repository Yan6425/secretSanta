<?php
session_start();
$parametres = json_decode(file_get_contents("../parametres.json"), true);
if (!isset($_SESSION["pseudo"]) || !$parametres["tirageFait"]){
    header("Location: ../index.php");
}
include "../header.html"
?>
holala tu es le secretSanta de Marie Hélène
<?php
include "../footer.html"
?>