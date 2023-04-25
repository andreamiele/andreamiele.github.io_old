<?php include("entete.php");
include("nav.php");
if(logged($BDD))
{
    if (logged_admin($BDD))
    {
        if(isset($_GET['S_ID']) && isset($_GET['P_ID']))
        {
            if (testHistory($BDD,$_GET['S_ID']))
            {

                $Requete="SELECT text, back_image, image, nbTrophee, Suite  FROM PARAGRAPHS WHERE S_ID =:NUMBERS AND P_ID=:NUMBERS2";
                $response = $BDD->prepare($Requete);
                $response->execute(array("NUMBERS"=>secure($_GET['S_ID']),"NUMBERS2"=>secure($_GET['P_ID'])));
                $readStoryInfo=$response->fetch();

                ?>
                <div class="conteneurpage" data-scroll-section>
                    <div class="emballage">
                        <div class="accueilsection">


                            <h1 class="accueiltitrelivre">
                                Modifier paragraphe n° <?= secure($_GET['P_ID']) ?>
                            </h1>

                        </div>
                        <?php


                        $R = "SELECT * FROM PARAGRAPHS WHERE S_ID=:NUMBER";
                        $r = $BDD->prepare($R);
                        $r->execute(array("NUMBER"=>secure($_GET['S_ID'])));?>
                        <form method="POST" action="functions/changepage.php">
                            <div class="selectdiv">
                                <select id="selection" class="select" name="NB_ID" onchange="this.form.submit()">
                                    <?php
                                    while($Count=$r->fetch())
                                    {
                                        $_SESSION['currentHistory']=$_GET['S_ID'];
                                        if ($Count['P_ID']==secure($_GET['P_ID']))
                                        {
                                            ?>
                                            <option selected value="<?= $Count['P_ID'] ?>"><?= $Count['P_ID'] ?></option>

                                        <?php }
                                        else{?>
                                            <option value="<?= $Count['P_ID'] ?>"><?= $Count['P_ID'] ?></option>
                                        <?php }
                                    }

                                    ?>
                                </select>
                            </div>
                        </form>

                        <div class="card-history-create" data-scroll data-scroll-speed="1">

                            <div class="card-body">
                                <form id="create" method="POST" action="functions/modifier_parag.php?P_ID=<?= secure($_GET['P_ID']) ?>&S_ID=<?= secure($_GET['S_ID']) ?>">

                                    <div class="field padding-bottom--24">
                                        <label for="Text">Texte</label>
                                        <textarea  id="Text" name="text"><?= $readStoryInfo['text']?></textarea>
                                    </div>

                                    <div class="field padding-bottom--24">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id ="image" value="<?= $readStoryInfo['image']?>">
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="selection">Suite de l'histoire</label>
                                        <div class="selectdiv">
                                            <select id="selection" class="select" name="select" >
                                                <option value="0">Victoire</option>
                                                <option value="1">Défaite</option>
                                                <option selected value="2">Continuer</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="trophée">Nombre de trophée</label>
                                        <input type="number" id="trophee" name="trophee" value="<?= $readStoryInfo['nbTrophee']?>">
                                    </div>
                                    <div id="parag">
                                        <div class="headingline2" ></div>
                                        <?php

                                        $Requete="SELECT ID_ARRIVEE,NOM_ACTION  FROM ACTIONS WHERE S_ID =:NUMBERS AND ID_DEPART =:NUMBERS2";
                                        $response = $BDD->prepare($Requete);
                                        $response->execute(array("NUMBERS"=>secure($_GET['S_ID']),"NUMBERS2"=>secure($_GET['P_ID'])));


                                        while($ActionInfo=$response->fetch())
                                        {
                                        ?>                        <div class="field padding-bottom--24">
                                            <label for="action">Action</label>
                                            <input type="text" id="action" name="action[]" value="<?=$ActionInfo['NOM_ACTION']?>"/>
                                        </div>
                                        <div class="field padding-bottom--24">
                                            <label for="nbaction">Numero du paragraphe</label>
                                            <input type="number" id="nbaction" name="action[]"  value="<?=$ActionInfo['ID_ARRIVEE']?>"/>
                                        </div>
                                    </div>

                                    <?php } ?>
                                    <div class="contactbutton">

                                        <button type="button" class="bn632-hover bn25"  id="btn" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                            </svg>
                                        </button>



                                    </div>
                                    <div class="contactbutton">
                                        <button type="submit" formaction="functions/modifier_parag.php?P_ID=<?= secure($_GET['P_ID']) ?>&S_ID=<?= secure($_GET['S_ID']) ?>" class="bn632-hover-2 bn25"  id="btn" >
                                            Modifier le paragraphe
                                        </button>
                                    </div>

                                </form>
                            </div>


                        </div>
                        </br>

                    </div>
                </div>
                <?php
                /*}
                else
                {

                }
            }*/
            }
        }
        else
        {
            echo "Access denied! You are not an administrator";
        }
    }}
else{?>
    <div class="conteneurpage" data-scroll-section>
        <div class="emballage">
            <div class="accueilsection">
                <h1 class="accueiltitrelivre">
                    Modifier histoire - Veuillez vous connecter
                </h1>
            </div>
        </div>
    </div>
<?php }
include("footer.php"); ?>
