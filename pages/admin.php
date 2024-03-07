<?php
session_start();
if (!isset($_SESSION["pseudo"]) || $_SESSION["pseudo"] != "Admin"){
    header("Location: ../index.php");
}
include "../header.html"
?>
azerty
<?php
include "../footer.html"
?>