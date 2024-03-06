<?php
session_start();
$parametres = json_decode(file_get_contents("../parametres.json"), true);
if (!isset($_SESSION["pseudo"])){
    header("Location: connexion.php");
}
else if ($parametres["tirageFait"]){
    header("Location: enAttente.php");
}
include "../header.html"
?>
azerty