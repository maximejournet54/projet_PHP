<?php
if (isset($_POST['deconnexion'])) {
    session_start();
    $_SESSION[] = array();
    session_destroy();
    header("location: accueil.php");
}
if (isset($_POST['retour']))
{
    header("location: accueil_redacteur.php");
}

?>

<html>
    <head>
        <title>Déconnexion</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <body id="hautdepage" class="texte">
    <h1 class="titre">Etes vous certain de vouloir vous déconnecter?</h1>
    <br>
    <form method="POST" >
        <input type='submit' name='deconnexion' value='deconnexion'></input>
        <input type='submit' name='retour' value='retour'></input>
    </form>
    </body>

    <footer>
        <a href="#hautdepage" style="margin-left: 20px;"> retourner en haut de la page </a> 
        <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
        <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
    </footer>
</html>
