<?php include("entete.php");
include("nav.php");
if(logged($BDD))
{
    if (isset($_GET['P_ID'])&&isset($_SESSION['id_histoire']))
    {

        ?>
        <div class="conteneurpage" data-scroll-section>
            <div class="emballage">
                <div class="accueilsection">


                    <h1 class="accueiltitrelivre">
                        Ecriture de paragraphe
                    </h1>

                </div>


                <div class="card-history-create" data-scroll data-scroll-speed="1">

                    <div class="card-body">
                        <form id="create" method="POST" action="ajout_paragraphe.php?P_ID=<?= secure($_GET['P_ID']) ?>"">

                        <div class="field padding-bottom--24">
                            <label for="Text">Texte</label>
                            <textarea  id="Text" name="text"></textarea>
                        </div>

                        <div class="field padding-bottom--24">
                            <label for="image">Image</label>
                            <input type="file" name="image" id ="image">
                        </div>
                        <div class="field padding-bottom--24">
                            <label for="selection">Suite de l'histoire</label>
                            <div class="selectdiv">
                                <select id="selection" class="select" name="select">
                                    <option value="0">Victoire</option>
                                    <option value="1">Défaite</option>
                                    <option value="2">Continuer</option>
                                </select>
                            </div>

                        </div>
                        <div class="field padding-bottom--24">
                            <label for="trophée">Nombre de trophée</label>
                            <input type="number" id="trophee" name="trophee"/>
                        </div>
                        <div id="parag">
                            <div class="headingline2" ></div>

                            <div class="field padding-bottom--24">
                                <label for="action">Action</label>
                                <input type="text" id="action" name="action[]"/>
                            </div>
                            <div class="field padding-bottom--24">
                                <label for="nbaction">Numero du paragraphe</label>
                                <input type="number" id="nbaction" name="action[]" />
                            </div>
                        </div>
                        <div class="contactbutton">

                            <button type="button" class="bn632-hover bn25"  id="btn" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>



                        </div>
                        <div class="contactbutton">
                            <button type="submit" formaction="ajout_paragraphe.php?P_ID=<?= secure($_GET['P_ID']) ?>" class="bn632-hover-2 bn25"  id="btn" >
                                Paragraphe suivant
                            </button>
                            <button type="submit" formaction="ajout_paragrapheFin.php?P_ID=<?= secure($_GET['P_ID']) ?>" class="bn632-hover-2 bn25"  id="btn" >
                                Terminer l'histoire
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
    else
    {
        echo "Access denied! You are not an administrator";
    }
}
include("footer.php"); ?>