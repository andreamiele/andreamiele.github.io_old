<?php include("entete.php");
include("nav.php");
if(logged($BDD))
{
    if (logged_admin($BDD))
    {
        if(isset($_GET['S_ID']))
        {
            if (testHistory($BDD,$_GET['S_ID']))
            {
                $Requete="SELECT title, `desc`, picture, tag, S_ID, create_date, auteur,hidden  FROM STORIES WHERE S_ID =:NUMBERS";
                $response = $BDD->prepare($Requete);
                $response->execute(array("NUMBERS"=>secure($_GET['S_ID'])));
                $readStoryInfo=$response->fetch()
                ?>

                <div class="conteneurpage" data-scroll-section>
                    <div class="emballage">
                        <div class="accueilsection">
                            <h1 class="accueiltitrelivre">
                                Modifier histoire
                            </h1>
                        </div>


                        <div class="card-history-create" data-scroll data-scroll-speed="1">
                            <div class="card-body">
                                <form id="stripe-login" method="POST" action="functions/modifier_histoire.php?S_ID=<?=$_GET['S_ID']?>">
                                    <div class="field padding-bottom--24">
                                        <label for="titre">Titre</label>
                                        <input type="text" name="titre" id ="titre" value="<?= $readStoryInfo['title']?>">
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="annee">Catégorie</label>
                                        <input type="text" name="categorie" id ="categorie" value="<?= $readStoryInfo['tag']?>">
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="annee">Date d'écriture</label>
                                        <input type="number" name="date" id ="date" value="<?= $readStoryInfo['create_date']?>">
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="couverture">Couverture</label>
                                        <input type="file" name="couverture" id ="couverture">
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="auteur">Auteur</label>
                                        <input type="text" name="auteur" id="auteur" value="<?= $readStoryInfo['auteur']?>">
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="textarea">Description</label>
                                        <textarea  id="textarea" name="descr"><?= $readStoryInfo['desc']?></textarea>
                                    </div>
                                    <div class="contactbutton">
                                        <button type="submit" class="bn632-hover-2 bn25">Modifier</button>
                                    </div>

                                </form>
                            </div>


                        </div>
                        </br>

                    </div>
                </div>
                <?php
            }}
        else{ ?>
            <div class="conteneurpage" data-scroll-section>
                <div class="emballage">
                    <div class="accueilsection">
                        <h1 class="accueiltitrelivre">
                            Modifier histoire - Veuillez clicker sur une histoire
                        </h1>
                    </div>
                </div>
            </div>
        <?php }
    }} else{ ?>
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