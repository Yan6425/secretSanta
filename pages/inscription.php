<?php
session_start();
if (isset($_SESSION["pseudo"])){
    header("Location: ../index.php");
}
include "../header.html"
?>
bientôt tu vas pouvoir t'inscrire, c'est cool non ?
<?php
include "../footer.html"
?>