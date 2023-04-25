<?php
session_start();
include('../connect.php');
function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
if (logged_admin($BDD)) {
    if (isset($_GET['S_ID']))
    {
        if (testHistory($BDD,$_GET['S_ID'])) {
            $history = secure($_GET['S_ID']);
            $Requete = "DELETE FROM STORIES WHERE `S_ID`=:NUM ;";
            $response = $BDD->prepare($Requete);
            $response->execute(array("NUM" => $history));

            $Requete = "DELETE FROM PARAGRAPHS WHERE `S_ID`=:NUM;";
            $response = $BDD->prepare($Requete);
            $response->execute(array("NUM" => $history));

            $Requete = "DELETE FROM ACTIONS WHERE `S_ID`=:NUM;";
            $response = $BDD->prepare($Requete);
            $response->execute(array("NUM" => $history));


            $Requete = "DELETE FROM MARQUAGE WHERE `S_ID`=:NUM;";
            $response = $BDD->prepare($Requete);
            $response->execute(array("NUM" => $history));
        }
    }
}
else{

}
header("Location:../index.php", TRUE, 301);
exit();
?>