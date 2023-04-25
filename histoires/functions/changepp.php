<?php session_start();
include("../connect.php");

function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
if(logged($BDD)) {

    if ($_FILES["pp"]["type"] != "")
    {
        $image = basename($_FILES['pp']['name']);
        $dossier = '../images/PP/';
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES["pp"]['name'], '.');
        if (!in_array($extension, $extensions)) {
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
        }

        if (!isset($erreur))
        {
            //deuxieme requete : Création de l'histoire dans la BDD
            $fichier = $_FILES["pp"]['name'];
            if (move_uploaded_file($_FILES["pp"]['tmp_name'], $dossier . $fichier))
            {
                //deuxieme requete : Création de l'histoire dans la BDD

                $Requete = "UPDATE USERS
                                SET profile_image=:pp
                                WHERE User_ID=:U_ID";
                $response = $BDD->prepare($Requete);
                $response->execute(
                    array(
                        "pp" => secure($image),
                        "U_ID" => secure($_SESSION['U_ID'])
                    ));
            }
        }
    }
}

$location = "Location: ../infos_logged.php";
header( $location);
exit();
