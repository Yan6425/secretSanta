<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
if (isset($_POST["pseudoBL"]) && isset($_POST["pseudo"])            //vérifie que les identifiants sont définis
    && array_key_exists($_POST["pseudoBL"], $participants)                                       
    && array_key_exists($_POST["pseudo"], $participants)){          //vérifie que l'utilisateur existe
        if (in_array($_POST["pseudo"], $participants[$_POST["pseudoBL"]]["blackList"])) {
            $participants[$_POST["pseudoBL"]]["blackList"] = array_values(
                array_diff(
                    $participants[$_POST["pseudoBL"]]["blackList"], 
                    [$_POST["pseudo"]]
                )
            );
        }
        else {
            array_push($participants[$_POST["pseudoBL"]]["blackList"], $_POST["pseudo"]);
        }
        file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
        echo "true";
}
else{
    echo "false";
}
?>