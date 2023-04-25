<?php include("entete.php") ?>
<?php include("nav.php") ?>

    <div class="conteneurpage" data-scroll-section>
        <div class="emballage">
            <div class="apropossection">
                <div class="accueilsection">


                    <h1 class="accueiltitrelivre">
                        A propos
                    </h1>

                </div>


                <div class="rang centr-y">
                    <div class="headingline" data-scroll data-scroll-speed="1"></div>
                    <h2 data-scroll data-scroll-speed="1">But de ce projet</h2>
                </div>
                <p class="paragrapheu" data-scroll data-scroll-speed="1">
                    Ce site est un projet scolaire pour l'ENSC. </br> </br>
                    "L’objectif du projet est de réaliser un site web reproduisant le concept des séries interactives (ex: Black Mirror, Bandersnatch) ou des livres-jeux de la collection Un livre dont vous êtes le héros.
                    On souhaite proposer aux utilisateurs la possibilité de suivre une histoire en lui laissant la possibilité d’influer sur le cours de celle-ci à travers une série de choix tout au long de son aventure.
                    Le site devra également permettre, à travers une interface d’administration, la création et la gestion de différentes histoires proposées aux utilisateurs.
                    Nous attachons une importance particulière à l’accessibilité de l’expérience que nous souhaitons proposer. Nous souhaitons proposer un site web qui ne mette personne à l’écart en étant accessible à tous, quelle que soit sa situation de vie."

                </p>
                <div class="rang centr-y">
                    <div class="headingline" data-scroll data-scroll-speed="1"></div>
                    <h2 data-scroll data-scroll-speed="1">Qui sommes-nous ?</h2>
                </div>
                <p class="paragrapheu" data-scroll data-scroll-speed="1">
                    Deux étudiants de l'ENSC (Ecole Nationale Supérieur de Cognitique):

                    <b>Benoît Lamirault et
                        Andrea Miele</b>
                </p>
                <div class="rang centr-y">
                    <div class="headingline" data-scroll data-scroll-speed="1"></div>
                    <h2 data-scroll data-scroll-speed="1">Téléchargement</h2>
                </div>
                <p class="paragrapheu" data-scroll data-scroll-speed="1">

                    <button onclick="window.open('enonce.pdf')" type="button" class="bn632-hover bn22">Enoncé</button>
                    <button onclick="window.open('rapport.pdf')" type="button" class="bn632-hover bn22">Rapport</button>
                    <button onclick="window.open('audit.pdf')" type="button" class="bn632-hover bn22">Audit</button>

                </p>
                </br>

            </div>
            <?php include("messagefin.php") ?>
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
<?php include("footer.php") ?>