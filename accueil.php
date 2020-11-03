<?php
    session_start();
    include "connection_bdd.php";
    $result = $objPdo->query('SELECT titrenews, datenews, textenews FROM news');
?>

<html>
    <head>
        <title>page d'accueil</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <header>
            <nav>
                <ul id="navigation">
                    <li><a href="inscription.php" title="Créer un compte">S'inscrire</a></li>
                    <li><a href="connection_redacteur.php" title="Se connecter">Connection</a></li>
                </ul>
            </nav>
    </header>

    <body id="hautdepage">  
        <h1 class="titre">Bienvenue sur notre site d'actualité!</h1> 
        <div class="texte">
            <p>Vous trouverez sur ce site des articles traitant de différentes actualités. <br> 
            Il est possible de se créer un compte pour écrire un nouvel article. <br>
            Voici ci-dessous quelques articles </p>
            <p> <label for="tri">les articles par: </label></p>
            <input list=tri1 id="tri" name="tri" >
            <datalist id=tri1>
                <option value="Date"> 
                <option value="Thème"> 
            </datalist>
        </div>

        <!--affichage des articles et de leur titre -->
        <?php
            foreach($result as $row){
                echo ("<h1 class='titre'>".$row['titrenews']."</h1><br>");
                echo ("<p class='article'>".$row['textenews']."<br><br>Date: ".$row['datenews']."</p><br>");
            }
        ?>

    </body>

    <footer>
        <a href="#hautdepage" style="margin-left: 20px;"> retourner en haut de la page </a> 
        <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
        <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
    </footer>
</html>