<?php
    session_start();
    include "connection_bdd.php";
    $result = $objPdo->query('SELECT titrenews, datenews, textenews FROM news');
?>

<html>
    <head>
        <title> Accueil rédacteur</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <header>
            <nav>
                <ul id="navigation">
                    <li><a href="ajoutArticle.php" title="Ecrire un nouvel article">Ajouter un article</a></li>
                    <li><a href="traitement_deconnexion.php" title="Se déconnecter">Déconnection</a></li>
                    <li><a href="suppression_compte.php" title="Supprimer le compte">Supprimer le compte</a></li>
                    <li><a href="#basdepage">Aller au bas de la page</a></li>
                </ul>
            </nav>
    </header>

    <body>

    <body id="hautdepage">  
        <h1 class="titre">Bienvenue sur notre site d'actualité!</h1> 
        <div class="texte">
            <p>Vous trouverez sur ce site des articles traitant de différentes actualités. <br> 
            Il est possible de se créer un compte pour écrire un nouvel article. <br>
            Voici ci-dessous quelques articles </p>
            <form method="POST" action="accueil.php">
                <p><label for="tri">Trier les articles par: </label></p>
                <select name="tri">
                    <?php
                        if (isset($_POST['tri'])&&$_POST['tri']==1) {
                            echo "<option value='1'> Thème
                            <option value='0'>Date";
                        }
                        else {
                            echo "<option value='0'> Date
                            <option value='1'> Thème";
                        }
                    ?>
                </select>
                <input type="submit" value="valider">
            </form>
        </div>

         <!--affichage des articles et de leur titre -->
         <?php
            if (isset($_POST['tri'])&&$_POST['tri']==1) {
                $req1="SELECT * FROM news,theme,redacteur WHERE news.idtheme=theme.idtheme and redacteur.idredacteur=news.idredacteur ORDER BY news.idtheme";
                $result=$objPdo->query($req1);
                foreach($result as $row){
                    echo ("<h1 class='titre'>".$row['titrenews']."</h1><br>");
                    echo ("<p class='article'>".$row['textenews']."<br><br>". "Thème: ".$row['description']."<br> Date: ".$row['datenews']."<br>"."Auteur: ".$row2['prenom']." ".$row2['nom']."</p>");
                }
            }
            elseif (!isset($_POST['tri'])||$_POST['tri']==0) {
                $req2="SELECT  * FROM news,theme,redacteur WHERE news.idtheme=theme.idtheme and redacteur.idredacteur=news.idredacteur ORDER BY news.datenews";
                $result2=$objPdo->query($req2);
                foreach($result2 as $row2){
                    echo ("<h1 class='titre'>".$row2['titrenews']."</h1><br>");
                    echo ("<p class='article'>".$row2['textenews']."<br><br>". "Thème: ".$row2['description']."<br> Date: ".$row2['datenews']."<br>"."Auteur: ".$row2['prenom']." ".$row2['nom']."</p>");
                }
            }   
        ?>

    </body>

    <footer id="basdepage">
        <nav>
            <ul id="navigation">
                    <li><a href="#hautdepage"> retourner en haut de la page </a> </li>
                    <li><a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a></li>
                    <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>        
            </ul>
        </nav>
    </footer>
</html>