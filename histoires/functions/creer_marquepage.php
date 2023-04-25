<?php session_start();
include("../connect.php");

function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
$chemin ="";
if(logged($BDD))
{
    foreach($_SESSION['chemin'] as $valeur)
    {
        $chemin.=($valeur." ");
    }
    if (isset($_GET['S_ID']) && isset($_GET['P_ID']))
    {
        if (testHistory($BDD,$_GET['S_ID'])) {
            $Requete = "INSERT INTO MARQUAGE (U_ID,S_ID,P_ID,CHEMIN) VALUES (:U_ID, :S_ID, :P_ID, :CHEMIN);";
            $response = $BDD->prepare($Requete);
            $response->execute(array("U_ID" => secure($_SESSION['U_ID']), "P_ID" => secure($_GET['P_ID']), "S_ID" => secure($_GET['S_ID']), "CHEMIN" => secure($chemin)));
        }
    }
}

$_SESSION['paragraphe']=1;
$_SESSION['paragraphes']=array($_SESSION['paragraphe']);

$location = "Location: ../read.php?S_ID=".secure($_GET['S_ID'])."&id=0";
header( $location);
exit();

?>

<!-- A appeler quand on commence l'histoire -->