<?php
include('entete.php');
include('nav.php');
if(!isset($_POST['Email'])|| isset($_SESSION['used_email']))
{
?>
<div data-scroll-section>
    <div class="accueilsection collaborons wf-section">
        <h2 class="headingcontact">S'inscrire</h2>
        <div class="center2">
            <div class="contactblock">
                <div class="contact">
                    <div class="formblockcentered">
                        <div class="form-block w-form">
                            <form id="wf-form-Contact-Form" name="wf-form-Contact-Form" data-name="Contact Form" method="POST" class="form" action="registration.php">
                                <div class="columns-3 w-row">
                                    <div class="columnnopaddingleft w-col w-col-6">
                                        <input type="text" class="contacttextfield w-input" maxlength="256" name="Nom" data-name="Nom" placeholder="Nom" id="Nom" required=""/>
                                        <input type="text" class="contacttextfield w-input" maxlength="256" name="Prénom" data-name="Prénom" placeholder="Prénom" id="Prénom" required=""/>
                                        <input type="text" class="contacttextfield w-input" maxlength="256" name="Email" data-name="Email" placeholder="Login" id="Email" required=""/>
                                        <?php if(isset($_SESSION['used_email']))
                                        {
                                            echo '<label for="Email" >Email already used !</label>';
                                            unset($_SESSION['used_email']);
                                        }?>
                                        <input id="password" type="password" class="contacttextfield w-input" maxlength="256" name="password" data-name="password" placeholder="Mot de passe" id="password" required=""/>

                                        <input id="password2"type="password" class="contacttextfield w-input" maxlength="256" name="password2" data-name="password2" placeholder="Confirmer le mot de passe" id="password2" required=""/>
                                        <div >
                                            <img id="error" src='img/gooseMot.png' style="display:none">
                                        </div>
                                    </div>
                                </div>

                                <div class="contactbutton">
                                    <button type='submit' class="bn632-hover-2 bn25">S'inscrire</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    else
    {
        $Requete="SELECT `login` 
                    FROM USERS;";
        $response = $BDD->prepare($Requete);
        $response->execute();
        $Emails=$response->fetchAll();
        foreach($Emails as $line)
        {
            if($line['login']==$_POST['Email'])
            {
                $_SESSION['used_email']=true;
            }
        }
        if(!isset($_SESSION['used_email']))
        {
            $Requete="SELECT `User_ID` 
                        FROM USERS;";
            $response = $BDD->prepare($Requete);
            $response->execute();
            $User_number=$response->fetch();
            $Requete="INSERT INTO USERS (Nom, Prenom, `login`, `password`, nbTrophees, `admin`) 
                        VALUES (:NOM, :PRENOM, :EMAIL, :PASS, 0, 0);";
            $response = $BDD->prepare($Requete);
            $response->execute(array("NOM"=>secure($_POST['Nom']),"PRENOM"=>secure($_POST['Prénom']),"EMAIL"=>secure($_POST['Email']), "PASS"=>secure(password_hash($_POST['password'],PASSWORD_BCRYPT))));
            header("Location:login.php", TRUE, 301);
            exit();
        }
        else
        {
            header("Location:registration.php", TRUE, 301);
            exit();
        }
    }
    ?>

    <?php include('footer.php');?>


</div>
<script src="locomotive-scroll.min.js"></script>
<script src="js.js"></script>
<script>
    (function () {
        var scroll = new LocomotiveScroll();
    })();


    var myInput = document.getElementById("password");
    var myInput2 = document.getElementById("password2");

    myInput2.addEventListener("change", ()=>{if (myInput2.value != myInput.value) {
        var error = document.getElementById("error");
        error.style.display="block";

    } else{
        document.getElementById("error").style.display="none";
    }})



</script>
</body>

</html>
