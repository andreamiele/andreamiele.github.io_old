<?php session_start();
include("connect.php");

function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
if(logged($BDD)) {
    if (isset($_POST['titre'])&&isset($_POST['descr'])&&isset($_POST['categorie'])&&isset($_POST['date'])&&isset($_POST['auteur']))
    {
        if (isset($_POST['couverture']))
        {
            if ($_FILES["couverture"]["type"] != "") {
                $image = basename($_FILES['couverture']['name']);
                $dossier = 'images/couverture/';
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES["couverture"]['name'], '.');
                if (!in_array($extension, $extensions)) {
                    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
                }

                if (!isset($erreur)) {
                    //deuxieme requete : Création de l'histoire dans la BDD
                    $fichier = $_FILES["couverture"]['name'];
                    if (move_uploaded_file($_FILES["couverture"]['tmp_name'], $dossier . $fichier)) {
                        //deuxieme requete : Création de l'histoire dans la BDD


                        $Requete = "INSERT INTO STORIES
            (title, `desc`, `tag`, `create_date`, picture, `auteur`, write_date) 
            VALUES (:TITLE, :DESCR, :TAG, :CREATE_DATE, :PIC, :AUTEUR, :WDATE);";
                        $response = $BDD->prepare($Requete);
                        $response->execute(array(
                            "TITLE" => secure($_POST['titre']),
                            "DESCR" => secure($_POST['descr']),
                            "TAG" => secure($_POST['categorie']),
                            "CREATE_DATE" => secure($_POST['date']),
                            "PIC" => secure($image),
                            "AUTEUR" => secure($_POST['auteur']),
                            "WDATE" => date("Ymd")));

                    } else {
                        echo 'Echec de l\'upload !';
                    }
                } else {
                    echo $erreur;
                }
            }
        }
        else {
            $Requete = "INSERT INTO STORIES 
            (title, `desc`  , `tag`, `create_date`, picture, `auteur`, write_date) 
            VALUES (:TITLE, :DESCR, :TAG, :CREATE_DATE, :PIC, :AUTEUR, :WDATE);";
            $response = $BDD->prepare($Requete);
            $response->execute(array(
                "TITLE" => secure($_POST['titre']),
                "DESCR" => secure($_POST['descr']),
                "TAG" => secure($_POST['categorie']),
                "CREATE_DATE" => secure($_POST['date']),
                "PIC" => null,
                "AUTEUR" => secure($_POST['auteur']),
                "WDATE" => date("Ymd")));
        }
    }



}
$_SESSION['id_histoire']= $BDD -> lastInsertId();
$location = "Location: write-parag.php?&P_ID=1";
header( $location);
exit();

?>

