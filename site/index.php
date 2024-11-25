<?php
session_start();
$parametres = json_decode(file_get_contents("../parametres.json"), true);
if (!isset($_SESSION["pseudo"])){
    header("Location: pages/connexion.php");
}
else if ($_SESSION["pseudo"] == "Admin"){
    header("Location: pages/admin.php");
}
else if ($parametres["tirageFait"]){
    header("Location: pages/devoiler.php");
}
else {
    header("Location: pages/enAttente.php");
}
?>