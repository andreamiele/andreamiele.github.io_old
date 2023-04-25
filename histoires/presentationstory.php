<?php include("entete.php") ?>
<?php include("nav.php") ?>

<div class="conteneurpage" data-scroll-section>
    <div class="emballage">
        <?php
        if(logged($BDD))
        {
        if(isset($_GET['S_ID']))
        {
        if (testHistory($BDD,$_GET['S_ID']))
        {
        $_SESSION['id_histoire']= secure($_GET['S_ID']);
        $Requete="SELECT title, `desc`, picture, tag, S_ID, create_date, auteur,hidden  
                            FROM STORIES 
                            WHERE S_ID =:NUMBERS";
        $response = $BDD->prepare($Requete);
        $response->execute(array("NUMBERS"=>secure($_GET['S_ID'])));
        $readStoryInfo=$response->fetch()
        ?>
        <div class="accueilsection">


            <h1 class="accueiltitrelivre">
                <?=$readStoryInfo['title']?>
            </h1>

        </div>

        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <div class="center">
                <form  action="">

                    <h1>Suppression histoire</h1>
                    <p>Voulez-vous vraiment supprimer cette histoire?</p>

                    <div class="clearfix">
                        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="bn632-hover bn22">Cancel</button>
                        <a href="functions/deletestorie.php?S_ID=<?=secure($_GET['S_ID'])?>"><button type="button" class="bn632-hover bn28">Delete</button></a>
                    </div>

                </form>
            </div>
        </div>

        <div class="card-history" style="display:flex; justify-content: space-around;" data-scroll data-scroll-speed="1">

            <div class="card-body" style=" width:60%;">

                <p>
                    <?=$readStoryInfo['desc']?>

                </p>
                <h3><?=$readStoryInfo['create_date']?></h3>
                <h3><?=$readStoryInfo['auteur']?></h3>
                <span class="tag tag-teal"><?=$readStoryInfo['tag']?></span>

                <?php
                if ($readStoryInfo['hidden']==0){?>
                    <span class="tag tag-green">Histoire disponible</span>
                <?php }
                else{ ?>
                    <span class="tag tag-red">Histoire cachée</span>
                <?php }
                ?>
            </div>
            <?php
            if ($readStoryInfo['picture']!=null){?><img width="300" height="300" src="images/couverture<?=$readStoryInfo['picture']?><?php }
            else{ ?><img width="300" height="300" src="https://picsum.photos/200/300<?php }?>" alt="<?=$readStoryInfo['tag']?>" />



        </div>
        </br>
        <?php
        $userStatus = logged_admin($BDD); //Request admin(bool)
        if ($userStatus) {
            ?>
            <div class="contactbutton">
                <a href="modifypage.php?S_ID=<?=secure($_GET['S_ID'])?>"><button class="bn632-hover bn25">Modifier l'histoire</button></a>
                <a href="modifyparag.php?S_ID=<?=secure($_GET['S_ID'])?>&P_ID=1"><button class="bn632-hover bn25">Modifier un paragraphe</button></a>
                <a href="ajouterParagraph.php"><button class="bn632-hover bn25">Ajouter un paragraphe</button></a>
                <?php
                if ($readStoryInfo['hidden']==0){?>
                    <a href="functions/hidden.php?info=0&S_ID=<?=secure($_GET['S_ID'])?>"><button class="bn632-hover bn25">Cacher l'histoire</button></a>
                <?php }
                else{ ?>
                    <a href="functions/hidden.php?info=1&S_ID=<?=secure($_GET['S_ID'])?>"><button class="bn632-hover bn25">Remettre l'histoire</button></a>
                <?php }
                ?>

                <button onclick="document.getElementById('id01').style.display='block'" class="bn632-hover bn25">Supprimer l'histoire</button>
            </div>
        <?php }
        $_SESSION['nbTrophee']=0;
        $_SESSION['chemin']=array();
        ?>
        <div class="contactbutton">
            <!-- CHECK SI L4HISTOIRE EST COMMENCEE OU NON -->



            <?php $Requete="SELECT * 
                            FROM MARQUAGE 
                            WHERE U_ID=:UID AND 
                                  S_ID=:SID";
            $response = $BDD->prepare($Requete);
            $response->execute(array("UID"=>secure($_SESSION['U_ID']),"SID"=>secure($_GET['S_ID'])));
            $readStoryInfo=$response->fetch();

            $Requete="SELECT COUNT(*) as nb 
                        FROM MARQUAGE 
                        WHERE U_ID=:UID AND 
                              S_ID=:SID";
            $response = $BDD->prepare($Requete);
            $response->execute(array("UID"=>secure($_SESSION['U_ID']),"SID"=>secure($_GET['S_ID'])));
            $Informations=$response->fetch();
            $_SESSION['paragraphe']=1;

            if ($Informations['nb']==0){
            ?>

            <a href="functions/creer_marquepage.php?S_ID=<?=secure($_GET['S_ID'])?>&P_ID=1"><button  class="bn632-hover-2 bn19">Lire l'histoire</button></a>
        </div>

    </div>
    <?php } else{ $_SESSION['paragraphe']=$readStoryInfo['P_ID'];
        $_SESSION['paragraphes']=array($_SESSION['paragraphe']);?>
        <a href="read.php?S_ID=<?=secure($_GET['S_ID'])?>&id=0"><button  class="bn632-hover-2 bn19">Lire l'histoire</button></a>


    <?php }
    }else{
        echo("Vous vous êtes perdus <br>");
        echo("<img src='img/no.jpeg'> <br>");
        echo("<div class='contactbutton'> <a href='index.php'><button  class='bn632-hover-2 bn19'>Retourner à l'accueil</button></a></div>");


    }
    }else{
        echo("Vous vous êtes perdus");
        echo("<div class='contactbutton'> <a href='index.php'><button  class='bn632-hover-2 bn19'>Retourner à l'accueil</button></a></div>");
    }
    }
    else
    {
        echo '<h1>You must create an account to read our stories ;)</h1> </br> <h2>Redirection ...</h2>';
        echo '<div class="contactbutton"><a href="login.php"><button  class="bn632-hover-2 bn19">Se connecter</button></a></div>';
    }
    ?>
</div>

<!-- Mettre la valeur prévue dans le paragraphe en paramètre de la fonction-->

<!-- Il faut mettre une valeur null ou inutilisé si on ne fait pas de random afin que je puisse faire un if / else -->

<?php include("footer.php") ?>

