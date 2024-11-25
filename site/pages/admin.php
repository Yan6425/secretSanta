<?php
session_start();
if (!isset($_SESSION["pseudo"]) || $_SESSION["pseudo"] != "Admin"){
    header("Location: ../index.php");
}
include "../header.html"
?>
azerty
<script type="text/javascript" src="../admin.js"></script>
<?php
include "../footer.html"
?>