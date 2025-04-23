<?php
$participants = json_decode(file_get_contents("../../participants.json"), true);
$actifs = $participants["actifs"];
if (isset($_POST["pseudoBL"]) && isset($_POST["pseudo"]) &&     //vérifie que les identifiants sont définis
    isset($actifs[$_POST["pseudoBL"]]) &&                                  
    isset($actifs[$_POST["pseudo"]])){         
        if (in_array($_POST["pseudo"], $actifs[$_POST["pseudoBL"]]["blackList"])) {
            $actifs[$_POST["pseudoBL"]]["blackList"] = array_values(
                array_diff(
                    $actifs[$_POST["pseudoBL"]]["blackList"], 
                    [$_POST["pseudo"]]
                )
            );
        }
        else {
            array_push($actifs[$_POST["pseudoBL"]]["blackList"], $_POST["pseudo"]);
        }
        $participants["actifs"] = $actifs;
        file_put_contents("../../participants.json", json_encode($participants, JSON_PRETTY_PRINT));
        echo "true";
}
else{
    echo "false";
}
?>