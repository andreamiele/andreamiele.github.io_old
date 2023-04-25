<?php include('entete.php');
include('nav.php');
if(isset($_POST['login']) && isset($_POST['Password']))
{
    $_SESSION['login']=secure($_POST['login']);
    $_SESSION['password']=secure($_POST['Password']);
    if(logged($BDD))
    {
        $_SESSION['connecte']=true;
        $Requete="SELECT * 
                        FROM USERS 
                        WHERE login=:LOGIN";
        $response = $BDD->prepare($Requete);
        $response->execute(array("LOGIN"=>secure($_SESSION['login'])));
        $readStoryInfo=$response->fetch();
        $_SESSION['U_ID']=$readStoryInfo['User_ID'];
        header("Location:index.php", TRUE, 301);
        exit();
    }
}
if(!logged($BDD))
{?>
    <div data-scroll-section>

        <div class="accueilsection collaborons wf-section">
            <h2 class="headingcontact">Se connecter</h2>
            <div class="center2">
                <div class="contactblock">
                    <div class="contact">
                        <div class="formblockcentered">
                            <div class="form-block w-form">
                                <form id="wf-form-Contact-Form" name="wf-form-Contact-Form" data-name="Contact Form" method="POST" class="form" action="">
                                    <div class="columns-3 w-row">
                                        <div class="columnnopaddingleft w-col w-col-6">
                                            <input type="text" class="contacttextfield w-input" maxlength="256" name="login" data-name="login" placeholder="Login" id="login" required=""/>

                                        </div>
                                        <div class="columnnopadding w-col w-col-6">

                                            <input type="password" class="contacttextfield w-input" maxlength="256" name="Password" data-name="Password" placeholder="Mot de Passe" id="Password" required=""/>

                                        </div>
                                    </div>

                                    <div class="contactbutton">
                                        <button type="submit" class="bn632-hover-2 bn25">Se connecter</button>

                                    </div>
                                </form>
                                <a href="registration.php"><button type="submit" class="bn632-hover-2 bn19">S'inscrire</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
    <?php
    if(logged($BDD))
    {
        $_SESSION['connecte']=true;
        header("Location:index.php", TRUE, 301);
        exit();
    }
}
include("footer.php");
?> 