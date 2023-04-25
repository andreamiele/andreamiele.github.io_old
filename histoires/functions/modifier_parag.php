<?php session_start();
include("../connect.php");
function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
$history = secure($_GET["S_ID"]);
$parag = secure($_GET["P_ID"]);
if(logged($BDD))
{
    if (isset($_GET['S_ID'])&&isset($_GET['P_ID']))
    {
        if (testHistory($BDD,$_GET['S_ID']))
        {
            if (logged_admin($BDD))
            {
                if ($_FILES["image"]["type"] != "") {
                    $image = basename($_FILES['image']['name']);
                    $dossier = '../images/paragraphs/';
                    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                    $extension = strrchr($_FILES["image"]['name'], '.');
                    if (!in_array($extension, $extensions)) {
                        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
                    }

                    if (!isset($erreur))
                    {
                        //deuxieme requete : Création de l'histoire dans la BDD
                        $fichier = $_FILES["image"]['name'];
                        if (move_uploaded_file($_FILES["image"]['tmp_name'], $dossier . $fichier)) {
                            $Requete = "UPDATE PARAGRAPHS
                            SET text=:TEXT, 
                                image=:IMAGE, 
                                Suite=:SUITE, 
                                nbTrophee=:NBTROPHEE
                            WHERE S_ID=:SID AND P_ID=:PID";
                            $response = $BDD->prepare($Requete);
                            $response->execute(
                                array(
                                    "TEXT" => secure($_POST['text']),
                                    "IMAGE" => secure($image),
                                    "NBTROPHEE" => secure($_POST['trophee']),
                                    "SUITE" => secure($_POST['select']),
                                    "SID" => secure($history),
                                    "PID" => secure($parag)
                                ));

                            $R = "DELETE FROM ACTIONS 
                                        WHERE 
                                              `S_ID`=:NUM AND 
                                              ID_DEPART=:DEP";
                            $response = $BDD->prepare($R);
                            $response->execute(array("DEP" => secure($parag), "NUM" => secure($history)));


                            for ($i = 0; $i < count($_POST['action']); $i++)
                            {
                                if ($i % 2 == 0)
                                {
                                    $A = $_POST['action'][$i];
                                    $B = $_POST['action'][$i + 1];


                                    $Requete = "INSERT INTO ACTIONS (ID_DEPART, NOM_ACTION, ID_ARRIVEE, CONSEQUENCE, S_ID) VALUES (:DEP,:NOM,:ARR,:CONS,:SID);";

                                    $response = $BDD->prepare($Requete);
                                    $response->execute(array("DEP" => secure($_GET['P_ID']), "NOM" => secure($A), "ARR" => secure($B), "CONS" => NULL, "SID" => secure($history)));
                                }
                            }
                        }
                    }
                }
                else
                {
                    $Requete = "UPDATE PARAGRAPHS 
                            SET text=:TEXT, 
                                Suite=:SUITE, 
                                nbTrophee=:NBTROPHEE
                            WHERE S_ID=:SID AND P_ID=:PID";
                    $response = $BDD->prepare($Requete);
                    $response->execute(
                        array(
                            "TEXT" => secure($_POST['text']),
                            "NBTROPHEE" => secure($_POST['trophee']),
                            "SUITE" => secure($_POST['select']),
                            "SID" => secure($history),
                            "PID" => secure($parag)
                        ));

                    $R = "DELETE FROM ACTIONS
                                WHERE 
                                      `S_ID`=:NUM AND 
                                      ID_DEPART=:DEP";
                    $response = $BDD->prepare($R);
                    $response->execute(array("DEP" => secure($parag), "NUM" => secure($history)));

                    for ($i = 0; $i < count($_POST['action']); $i++) {
                        if ($i % 2 == 0) {
                            $A = $_POST['action'][$i];
                            $B = $_POST['action'][$i + 1];


                            $Requete = "INSERT INTO ACTIONS (ID_DEPART, NOM_ACTION, ID_ARRIVEE, CONSEQUENCE, S_ID) VALUES (:DEP,:NOM,:ARR,:CONS,:SID);";

                            $response = $BDD->prepare($Requete);
                            $response->execute(array("DEP" => secure($_GET['P_ID']), "NOM" => secure($A), "ARR" => secure($B), "CONS" => NULL, "SID" => secure($history)));
                        }
                    }
                }
            }
        }
    }
}

header("Location: ../presentationstory.php?S_ID=".$history);
exit();
