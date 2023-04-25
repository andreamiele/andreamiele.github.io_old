<?php
session_start();
include('connect.php');
function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
if(logged($BDD))
{
    $Requete="SELECT `User_ID` as id FROM USERS WHERE `login`=:LOGIN;";
    $response = $BDD->prepare($Requete);
    $response->execute(array("LOGIN"=>secure($_SESSION['login'])));
    $_COOKIE=$response->fetch();


    $Requete="DELETE FROM USERS WHERE `login`=:LOGIN;";
    $response = $BDD->prepare($Requete);
    $response->execute(array("LOGIN"=>secure($_SESSION['login'])));
}
header("Location:logout.php", TRUE, 301);
exit();
?>