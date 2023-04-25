<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function logged($BDD)
{ if(isset($_SESSION['login']) && isset($_SESSION['password']))
{
    $Requete="SELECT * 
                    FROM USERS
                    WHERE login=:LOGIN";
    $response = $BDD->prepare($Requete);
    $response->execute(array(
        "LOGIN" => secure($_SESSION['login'])
    ));
    while($_COOKIE=$response->fetch())
    {
        if(password_verify($_SESSION['password'],$_COOKIE['password']))
        {
            $Requete="SELECT `Nom`, Prenom,nbTrophees 
                            FROM USERS 
                            WHERE login=:LOGIN";
            $response = $BDD->prepare($Requete);
            $response->execute(array("LOGIN" => secure($_SESSION['login'])));
            $_COOKIE=$response->fetch();
            $_SESSION['nom']=$_COOKIE['Nom'];
            $_SESSION['prenom']=$_COOKIE['Prenom'];
            $_SESSION['tresor']=$_COOKIE['nbTrophees'];
            return true;
        }
    }
}

    return false;
}
function logged_admin($BDD)
{
    if(isset($_SESSION['login']) && isset($_SESSION['password']))
    {
        $Requete="SELECT `password` as pass 
                    FROM USERS 
                    WHERE login=:LOGIN AND 
                          admin=1";
        $response = $BDD->prepare($Requete);
        $response->execute(array(
            "LOGIN" => secure($_SESSION['login'])
        ));
        while($_COOKIE=$response->fetch())
        {
            if(password_verify($_SESSION['password'],$_COOKIE['pass']))
            {
                return true;
            }
        }
    }
    return false;
}
try {
    $BDD = new PDO( "mysql:host=91.216.107.164;dbname=andre1787219;charset=utf8",
        "andre1787219","vE8!18Td!uYY1E7", array(PDO::ATTR_ERRMODE
        =>PDO::ERRMODE_EXCEPTION));
} /*POUR ZZZ */


    /*$BDD = new PDO( "mysql:host=localhost;dbname=Histoires;charset=utf8",
"amiele","amiele", array(PDO::ATTR_ERRMODE
=>PDO::ERRMODE_EXCEPTION));
} POUR LOCAL HOST*/


# Résultat du form de login.php: $_POST['login'] et $_POST['password']
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}

function testHistory($BDD,$nb){
    $Requete="SELECT COUNT(*) as nb 
                FROM STORIES 
                WHERE S_ID=:S_ID";
    $response = $BDD->prepare($Requete);
    $response->execute(array(
        "S_ID" =>secure($nb)
    ));

    $Reponse=$response->fetch();
    if ($Reponse['nb']!=0){
        return true;
    }
    else{
        return false;
    }
}


function testId($arr,$id){
    if ($id<count($arr)){
        return true;
    }
    else{
        return false;
    }
}
?>