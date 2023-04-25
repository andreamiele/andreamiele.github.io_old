<?php include("entete.php") ?>
<?php include("nav.php") ?>

<div class="conteneurpage" data-scroll-section>
    <div class="emballage">
        <div class="accueilsection">
            <div class="accueilcolonnes">

                    <h1 class="accueiltitrelivre">
                        Lire une histoire
                    </h1>
            </div>
        </div>

        <!-- DIV A ECHO connexion connexion-->
        <!-- DIV A ECHO -->
        <!-- DIV A ECHO -->
        <!-- DIV A ECHO -->
        <!-- DIV A ECHO -->
        <!-- DIV A ECHO -->
        <div id="snackbar">Vous êtes connectés</div>




        <div class="emballage">
            <?php
            if(logged($BDD))
            {
                ?>
                <div class="accueilsection">
                    <div class="emballagecontenu">
                        <div class="rang centr-y">
                            <div class="headingline" data-scroll data-scroll-speed="1"></div>
                            <h2 data-scroll data-scroll-speed="1">Histoires commencées</h2>
                        </div>
                        <div class="container swiper" >
                            <div class="swiper-wrapper" data-scroll data-scroll-speed="1">
                                <?php
                                $Requete="SELECT * FROM STORIES";

                                $response = $BDD->prepare($Requete);
                                $response->execute();


                                $userStatus = logged_admin($BDD);
                                while($stories=$response->fetch())
                                {
                                    $Requete="SELECT COUNT(*) as nb 
                                                FROM MARQUAGE
                                                WHERE U_ID=:UID AND 
                                                      S_ID=:SID";

                                    $response2 = $BDD->prepare($Requete);
                                    $response2->execute(array("UID"=>secure($_SESSION['U_ID']),"SID"=>secure($stories['S_ID'])));
                                    $count=$response2->fetch();
                                    $Requete="SELECT * 
                                                FROM MARQUAGE 
                                                WHERE U_ID=:UID AND 
                                                      S_ID=:SID";

                                    $response2 = $BDD->prepare($Requete);
                                    $response2->execute(array("UID"=>secure($_SESSION['U_ID']),"SID"=>secure($stories['S_ID'])));
                                    $infos=$response2->fetch();
                                    if ($stories['hidden']==0 || $userStatus){
                                        if($count['nb']!=0){
                                            ?>
                                            <div class="card swiper-slide" >
                                                <div class="card-body-due">
                                                    <h3>
                                                        <?=$stories['title']?>
                                                    </h3>
                                                </div>
                                                <a href="presentationstory.php?S_ID=<?= $stories['S_ID'] ?>">
                                                    <div class="card-header">
                                                        <?php
                                                        if ($stories['picture']!=null){?><img src="images/couverture<?=$stories['picture']?><?php }
                                                        else{ ?><img src="https://picsum.photos/200/300<?php }?>" alt="<?=$stories['tag']?>" />
                                                    </div>
                                                </a>
                                                <div class="card-body">
                                                    <p>
                                                        <?=$stories['desc']?>
                                                    </p>
                                                    <span class="tag tag-orange">Avancement : <?=$infos['P_ID']?></span>
                                                    <span><?=$stories['vues']?> vue(s)</span>
                                                    <!--
                                                    <div class="user">
                                                        <img src="https://yt3.ggpht.com/a/AGF-l7-0J1G0Ue0mcZMw-99kMeVuBmRxiPjyvIYONg=s900-c-k-c0xffffffff-no-rj-mo" alt="user" />
                                                        <div class="user-info">
                                                            <h5>July Dec</h5>
                                                            <small>2h ago</small>
                                                        </div>
                                                    </div>
                                                    -->
                                                </div>
                                            </div>
                                            <?php


                                        }
                                    }

                                }


                                ?>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev" data-scroll data-scroll-speed="1"></div>
                            <div class="swiper-button-next" data-scroll data-scroll-speed="1"></div>

                            <!-- If we need scrollbar -->
                            <div class="swiper-scrollbar" data-scroll data-scroll-speed="1"></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="accueilsection">
                <div class="emballagecontenu">
                    <div class="rang centr-y">
                        <div class="headingline" data-scroll data-scroll-speed="1"></div>
                        <h2 data-scroll data-scroll-speed="1">Toutes les histoires</h2>
                    </div>

                    <div class="container swiper" >
                        <div class="swiper-wrapper" data-scroll data-scroll-speed="1">
                            <?php
                            $Requete="SELECT * FROM STORIES";

                            $response = $BDD->prepare($Requete);
                            $response->execute();


                            $userStatus = logged_admin($BDD);
                            while($stories=$response->fetch())
                            {
                                if ($stories['hidden']==0 || $userStatus){
                                    ?>
                                    <div class="card swiper-slide" >
                                        <div class="card-body-due">
                                            <h3>
                                                <?=$stories['title']?>
                                            </h3>
                                        </div>
                                        <a href="presentationstory.php?S_ID=<?= $stories['S_ID'] ?>">
                                            <div class="card-header">
                                                <?php
                                                if ($stories['picture']!=null){?><img src="images/couverture<?=$stories['picture']?><?php }
                                                else{ ?><img src="https://picsum.photos/200/300<?php }?>" alt="<?=$stories['tag']?>" />
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <p>
                                                <?=$stories['desc']?>
                                            </p>
                                            <span class="tag tag-teal"><?=$stories['tag']?></span>
                                            <span><?=$stories['vues']?> vue(s)</span>
                                            <!--
                                            <div class="user">
                                                <img src="https://yt3.ggpht.com/a/AGF-l7-0J1G0Ue0mcZMw-99kMeVuBmRxiPjyvIYONg=s900-c-k-c0xffffffff-no-rj-mo" alt="user" />
                                                <div class="user-info">
                                                    <h5>July Dec</h5>
                                                    <small>2h ago</small>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                    <?php



                                }

                            }


                            ?>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev" data-scroll data-scroll-speed="1"></div>
                        <div class="swiper-button-next" data-scroll data-scroll-speed="1"></div>

                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar" data-scroll data-scroll-speed="1"></div>
                    </div>
                </div>
            </div>

            <div class="accueilsection">
                <div class="emballagecontenu">
                    <div class="rang centr-y">
                        <div class="headingline" data-scroll data-scroll-speed="1"></div>
                        <h2 data-scroll data-scroll-speed="1">Nouvelles histoires</h2>
                    </div>
                    <div class="container swiper" >
                        <div class="swiper-wrapper" data-scroll data-scroll-speed="1">
                            <?php
                            $Requete="SELECT * FROM STORIES ORDER BY write_date ASC ";

                            $response = $BDD->prepare($Requete);
                            $response->execute();


                            $userStatus = logged_admin($BDD);
                            while($stories=$response->fetch())
                            {
                                if ($stories['hidden']==0 || $userStatus){
                                    ?>
                                    <div class="card swiper-slide" >
                                        <div class="card-body-due">
                                            <h3>
                                                <?=$stories['title']?>
                                            </h3>
                                        </div>
                                        <a href="presentationstory.php?S_ID=<?= $stories['S_ID'] ?>">
                                            <div class="card-header">
                                                <?php
                                                if ($stories['picture']!=null){?><img src="images/couverture<?=$stories['picture']?><?php }
                                                else{ ?><img src="https://picsum.photos/200/300<?php }?>" alt="<?=$stories['tag']?>" />
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <p>
                                                <?=$stories['desc']?>
                                            </p>
                                            <span class="tag tag-teal"><?=$stories['tag']?></span>
                                            <span><?=$stories['vues']?> vue(s)</span>
                                            <!--
                                            <div class="user">
                                                <img src="https://yt3.ggpht.com/a/AGF-l7-0J1G0Ue0mcZMw-99kMeVuBmRxiPjyvIYONg=s900-c-k-c0xffffffff-no-rj-mo" alt="user" />
                                                <div class="user-info">
                                                    <h5>July Dec</h5>
                                                    <small>2h ago</small>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                    <?php



                                }

                            }


                            ?>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev" data-scroll data-scroll-speed="1"></div>
                        <div class="swiper-button-next" data-scroll data-scroll-speed="1"></div>

                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar" data-scroll data-scroll-speed="1"></div>
                    </div>
                </div>
            </div>

            <div class="accueilsection">
                <div class="emballagecontenu">
                    <div class="rang centr-y">
                        <div class="headingline" data-scroll data-scroll-speed="1"></div>
                        <h2 data-scroll data-scroll-speed="1">Trending</h2>
                    </div>
                    <div class="container swiper" >
                        <div class="swiper-wrapper" data-scroll data-scroll-speed="1">
                            <?php
                            $Requete="SELECT * FROM STORIES ORDER BY vues DESC ";

                            $response = $BDD->prepare($Requete);
                            $response->execute();


                            $userStatus = logged_admin($BDD);
                            while($stories=$response->fetch())
                            {
                                if ($stories['hidden']==0 || $userStatus){
                                    ?>
                                    <div class="card swiper-slide" >
                                        <div class="card-body-due">
                                            <h3>
                                                <?=$stories['title']?>
                                            </h3>
                                        </div>
                                        <a href="presentationstory.php?S_ID=<?= $stories['S_ID'] ?>">
                                            <div class="card-header">
                                                <?php
                                                if ($stories['picture']!=null){?><img src="images/couverture<?=$stories['picture']?><?php }
                                                else{ ?><img src="https://picsum.photos/200/300<?php }?>" alt="<?=$stories['tag']?>" />
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <p>
                                                <?=$stories['desc']?>
                                            </p>
                                            <span class="tag tag-teal"><?=$stories['tag']?></span>
                                            <span><?=$stories['vues']?> vue(s)</span>
                                            <!--
                                            <div class="user">
                                                <img src="https://yt3.ggpht.com/a/AGF-l7-0J1G0Ue0mcZMw-99kMeVuBmRxiPjyvIYONg=s900-c-k-c0xffffffff-no-rj-mo" alt="user" />
                                                <div class="user-info">
                                                    <h5>July Dec</h5>
                                                    <small>2h ago</small>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                    <?php



                                }

                            }


                            ?>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev" data-scroll data-scroll-speed="1"></div>
                        <div class="swiper-button-next" data-scroll data-scroll-speed="1"></div>

                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar" data-scroll data-scroll-speed="1"></div>
                    </div>
                </div>
            </div>
            </div>




        </div>








        <?php include("messagefin.php") ?>
    </div>
</div>

<!-- SCRIPT A ECHO POUR LA CONNEXIONNNN-->
<!-- SCRIPT A ECHO POUR LA CONNEXIONNNN-->
<!-- SCRIPT A ECHO POUR LA CONNEXIONNNN-->
<!-- SCRIPT A ECHO POUR LA CONNEXIONNNN-->
<!-- SCRIPT A ECHO POUR LA CONNEXIONNNN-->
<!-- SCRIPT A ECHO POUR LA CONNEXIONNNN-->
<script>
    function myFunction() {



        // Get the snackbar DIV
        var x = document.getElementById("snackbar");

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>

<?php include("footer.php"); ?>
