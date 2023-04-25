<?php
include('connect.php');
if(logged($BDD)) {
    if (isset($_GET['S_ID'])&&testHistory($BDD,secure($_GET['S_ID'])))
    {
        $Requete = "UPDATE STORIES 
                    SET `hidden`=1 
                    WHERE S_ID=:ID";
        $response = $BDD->prepare($Requete);
        $response->execute(array("ID" => secure($_GET['S_ID'])));
    }
}
else
{
    header("Location:index.php", TRUE, 301);
    exit();
}
?>