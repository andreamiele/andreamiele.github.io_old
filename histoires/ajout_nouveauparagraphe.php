<?php session_start();
include("connect.php");

function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
if(logged($BDD)) {
    if (isset($_POST['numero'])&&isset($_SESSION['id_histoire'])&&isset($_SESSION['text'])&&isset($_SESSION['trophee'])&&isset($_SESSION['select'])&&isset($_SESSION['action'])&&isset($_GET['P_ID'])) {

        $Requete = "SELECT COUNT(*) as nb FROM PARAGRAPHS WHERE P_ID=:PID AND S_ID =:SID";

        $response = $BDD->prepare($Requete);
        $response->execute(array("PID" => secure($_POST['numero']),"SID" => secure($_SESSION['id_histoire'])));
        $count = $response -> fetch();
        if ($count['nb']==0) {

            if ($_FILES["image"]["type"] != "") {
                $image = basename($_FILES['image']['name']);
                $dossier = 'images/paragraphs/';
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES["image"]['name'], '.');
                if (!in_array($extension, $extensions)) {
                    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
                }

                if (!isset($erreur)) {
                    //deuxieme requete : Création de l'histoire dans la BDD
                    $fichier = $_FILES["image"]['name'];
                    if (move_uploaded_file($_FILES["image"]['tmp_name'], $dossier . $fichier)) {
                        $Requete = "INSERT INTO PARAGRAPHS (S_ID, P_ID, text, back_image, image, nbTrophee, Suite) 
                                VALUES (:S_ID, :PID, :TEXT, :BIMAGE, :IMAGE, :NBTROPHEE, :SUITE);";

                        $response = $BDD->prepare($Requete);
                        $response->execute(array("S_ID" => secure($_SESSION['id_histoire']), "PID" => secure($_POST['numero']), "TEXT" => secure($_POST['text']), "BIMAGE" => secure($_POST['image']), "IMAGE" => secure($image), "NBTROPHEE" => secure($_POST['trophee']), "SUITE" => secure($_POST['select'])));
                        $_SESSION['id_parag'] = $_GET['P_ID'];
                        $_SESSION['id_parag'] += 1;

                        for ($i = 0; $i < count($_POST['action']); $i++) {
                            if ($i % 2 == 0) {
                                $A = $_POST['action'][$i];
                                $B = $_POST['action'][$i + 1];
                                $Requete = "INSERT INTO ACTIONS (ID_DEPART, NOM_ACTION, ID_ARRIVEE, CONSEQUENCE, S_ID) 
                                        VALUES (:DEP,:NOM,:ARR,:CONS,:SID);";

                                $response = $BDD->prepare($Requete);
                                $response->execute(array("DEP" => secure($_POST['numero']), "NOM" => secure($A), "ARR" => secure($B), "CONS" => NULL, "SID" => secure($_SESSION['id_histoire'])));
                            }
                        }
                    }
                }
            } else {
                $Requete = "INSERT INTO PARAGRAPHS (S_ID, P_ID, text, back_image, image, nbTrophee, Suite) 
                        VALUES (:S_ID, :PID, :TEXT, :BIMAGE, :IMAGE, :NBTROPHEE, :SUITE);";
                $response = $BDD->prepare($Requete);
                $response->execute(array("S_ID" => secure($_SESSION['id_histoire']), "PID" => secure($_POST['numero']), "TEXT" => secure($_POST['text']), "BIMAGE" => secure($_POST['image']), "IMAGE" => secure($_POST['image']), "NBTROPHEE" => secure($_POST['trophee']), "SUITE" => secure($_POST['select'])));
                $_SESSION['id_parag'] = secure($_GET['P_ID']);
                $_SESSION['id_parag'] += 1;

                for ($i = 0; $i < count($_POST['action']); $i++) {
                    if ($i % 2 == 0) {
                        $A = $_POST['action'][$i];
                        $B = $_POST['action'][$i + 1];
                        $Requete = "INSERT INTO ACTIONS (ID_DEPART, NOM_ACTION, ID_ARRIVEE, CONSEQUENCE, S_ID) 
                                VALUES (:DEP,:NOM,:ARR,:CONS,:SID);";

                        $response = $BDD->prepare($Requete);
                        $response->execute(array("DEP" => secure($_POST['numero']), "NOM" => secure($A), "ARR" => secure($B), "CONS" => NULL, "SID" => secure($_SESSION['id_histoire'])));

                    }
                }
            }
        }
    }
}
$location = "Location: presentationstory.php?S_ID=".secure($_SESSION['id_histoire']);
header( $location);
exit();

?>