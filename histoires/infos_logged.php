<?php include("entete.php") ?>
<?php include("nav.php");

if(logged($BDD))
{
    $Requete="SELECT * FROM USERS 
            WHERE login=:LOGIN";
    $response = $BDD->prepare($Requete);
    $response->execute(array("LOGIN"=>secure($_SESSION['login'])));
    $users=$response->fetch();
    ?>

    <div class="conteneurpage" data-scroll-section>
        <div class="emballage">
            <div class="accueilsection">


                <h1 class="accueiltitrelivre">
                    Bienvenue <?php echo(secure($_SESSION["nom"])." ".secure($_SESSION["prenom"])) ?> <!-- Mettre le nom d'utilisateur qui est connecté -->
                </h1>

            </div>
            <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <div class="center">
                    <form  action="">

                        <h1>Suppression de compte</h1>
                        <p>Voulez-vous vraiment supprimer votre compte ?</p>

                        <div class="clearfix">
                            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="bn632-hover bn22">Cancel</button>
                            <a href='deleteaccount.php'><button type="button" class="bn632-hover bn25">Delete</button></a>
                        </div>

                    </form>
                </div>
            </div>

            <div class="card-history2" data-scroll data-scroll-speed="1">
                <div class="accueilrang-el-ments centre">

                    <div class="div-block-5">

                        <b>Login : </b> </br>
                        <?php echo($_SESSION["login"])?>

                    </div>

                    <div class="div-block-5" >
                        <?php if ($users['profile_image']!=null){ ?>
                            <img width="200" src="images/PP/<?=$users['profile_image'] ?>">
                        <?php } ?>
                        <form id="create" method="POST" action="functions/changepp.php" enctype="multipart/form-data">
                            <div class="field padding-bottom--24">
                                <label for="pp">Photo de profil</label>
                                <input type="file" name="pp" id ="pp">
                            </div>
                            <div class="contactbutton">
                                <button type="submit" class="bn632-hover bn22">Changer</button>
                            </div>
                        </form>

                    </div>

                    <div class="div-block-5">

                        <b>Nombre d'histoires jouées :</b> <?php echo $users["Played"] ?>
                        <b>Nombre de victoires :</b> <?php echo $users["Won"] ?>
                        <b>Nombre de défaites :</b><?php echo $users["Lost"] ?>

                    </div>
                    <div class="div-block-5">

                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                            <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"/>
                        </svg>  <h3><?php echo(secure($_SESSION["tresor"]))?></h3>

                    </div>


                </div>
            </div>
            </br>
            <div class="contactbutton">
                <a href="logout.php" ><button class="bn632-hover-2 bn25">Se déconnecter</button></a>
                <button class="bn632-hover-2 bn25" onclick="document.getElementById('id01').style.display='block'">Supprimer mon compte</button>
            </div>
            <?php
            $userStatus = logged_admin($BDD); //Request admin(bool)
            if ($userStatus) {
                ?>
                <div class="contactbutton">
                    <a href="adminpannel.php"><button class="bn632-hover bn28">Interface admin</button></a>
                </div>
            <?php } ?>
        </div>
    </div>


    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }

        }
    </script>
    <?php
}else{ ?>
    <div class="conteneurpage" data-scroll-section>
        <div class="emballage">
            <div class="accueilsection">
                <h1 class="accueiltitrelivre">
                    Veuillez vous connecter.
                </h1>
            </div>
        </div>
    </div>


<?php }

include("footer.php") ?>