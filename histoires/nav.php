<?php session_start();
include('connect.php');
function secure($user_input)
{
    $secure_input=htmlspecialchars($user_input,ENT_QUOTES,'UTF-8',false);
    return $secure_input;
}
?>
<div class="white">
    <div class="containeurnav white">
        <div class="rang-nav white2">
            <a href="index.php" class="w-nav-brand"><img width="50" src="img/logo.png"></a>
            <nav class="nav-menu w-nav-menu">

                <a href="lireunehistoire.php" class="link link--metis">
                    <div class="textwrapper2">
                        <div class="up">
                            Lire une histoire
                        </div>
                    </div>
                </a>

                <a href="write-history.php" class="link link--metis">
                    <div class="textwrapper2">
                        <div class="up">
                            Ecrire une histoire
                        </div>
                    </div>
                </a>

                <a href="infos.php" class="link link--metis">
                    <div class="textwrapper2">
                        <div class="up">
                            A propos
                        </div>
                    </div>
                </a>

            </nav>

            <div class="link link--metis">
                <?php
                if(logged($BDD))
                {?>

                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium text-black-700   md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto" style="background-color:white;"><?=$_SESSION['login']?><svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="infos_logged.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profil</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Se déconnecter</a>
                        </div>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <a href="login.php" class="up">Se connecter</a>

                    <?php
                }
                ?>

            </div>
        </div> <!-- rang nav -->
    </div> <!-- containeurnav -->
</div> <!-- white -->

<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.add("show");
    }


</script>
