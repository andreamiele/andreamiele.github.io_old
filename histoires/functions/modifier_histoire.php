<?php session_start();
include("../connect.php");
function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
$history = secure($_GET["S_ID"]);
if(logged($BDD))
{
    if (isset($_GET['S_ID']))
    {
        if (testHistory($BDD, $_GET['S_ID']))
        {
            if (logged_admin($BDD))
            {
                if ($_FILES["couverture"]["type"] != "") {
                    $image = basename($_FILES['couverture']['name']);
                    $dossier = '../images/couverture/';
                    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                    $extension = strrchr($_FILES["couverture"]['name'], '.');
                    if (!in_array($extension, $extensions)) {
                        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
                    }

                    if (!isset($erreur))
                    {
                        //deuxieme requete : Création de l'histoire dans la BDD
                        $fichier = $_FILES["couverture"]['name'];
                        if (move_uploaded_file($_FILES["couverture"]['tmp_name'], $dossier . $fichier)) {
                            $Requete = "UPDATE STORIES 
                                SET title=:TITLE, 
                                    `desc`=:DESCR, 
                                    `tag`=:TAG,
                                    create_date=:CDATE, 
                                    picture=:PIC, 
                                    auteur=:AUTEUR 
                                WHERE S_ID=:SID";
                            $response = $BDD->prepare($Requete);
                            $response->execute(
                                array(
                                    "TITLE" => secure($_POST['titre']),
                                    "DESCR" => secure($_POST['descr']),
                                    "TAG" => secure($_POST['categorie']),
                                    "CDATE" => secure($_POST['date']),
                                    "PIC" => secure($image),
                                    "AUTEUR" => secure($_POST['auteur']),
                                    "SID" => secure($_GET['S_ID']),
                                ));
                        } else {
                            echo 'Echec de l\'upload !';
                        }
                    } else {
                        echo $erreur;
                    }
                }

                else
                {

                    $Requete = "UPDATE STORIES 
                SET title=:TITLE, 
                    `desc`=:DESCR, 
                    `tag`=:TAG,
                    create_date=:CDATE, 
                    auteur=:AUTEUR 
                WHERE S_ID=:SID";
                    $response = $BDD->prepare($Requete);
                    $response->execute(
                        array(
                            "TITLE" => secure($_POST['titre']),
                            "DESCR" => secure($_POST['descr']),
                            "TAG" => secure($_POST['categorie']),
                            "CDATE" => secure($_POST['date']),
                            "AUTEUR" => secure($_POST['auteur']),
                            "SID" => secure($_GET['S_ID']),
                        ));
                }
            }
        }
    }
    else
    {

    }
}
else
{

}
header("Location: ../presentationstory.php?S_ID=".$history);
exit();