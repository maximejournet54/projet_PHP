<!-- page de connection d'un rédacteur au site pour pouvoir créer et intéragir avec les fonctionnalitées du site -->

<?php
    session_start();
    include "connection_bdd.php";

    if(isset($_POST['identifiant'])&& isset($_POST['motdepasse'])){
        $bSoumis=1;
    //  $req=$objPdo->prepare('select adressemail,motdepasse from redacteur where adressemail = :mail and motdepasse = :password');
        $result=$objPdo->query('select * from redacteur');
        foreach ($result as $row) {
            if ($_POST['identifiant'] ==  $row['adressemail']&& $_POST['motdepasse'] == $row['motdepasse'])
            {
                $_SESSION['login'] = 'ok';
                if ($_SESSION['url'] != '')
                    header("location: {$_SESSION['url']}");
                else header("location: accueil_redacteur.php");

                //pour pouvoir récupérer l'id dans un autre script
                $_SESSION['idredacteur']=$row['idredacteur'];
                $_SESSION['nom']=$row['nom'];
                $_SESSION['prenom']=$row['prenom'];

            }
        }
    }
    else
        $bSoumis=0;
?>

<html>
    <head>
        <title>Connection au site</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <header>
            <nav id="navigation">
                <ul>
                    <li><a href="./inscription.php">Inscription </a></li>  
                    <li><a href="./accueil.php"> Retour à l'accueil</a></li>  
                </ul>
            </nav>
    </header>

    <body id="hautdepage" class="texte">
        
            <article>
                <h1 class="titre">Connexion</h1>
                <form method="POST" > <br> <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
                    <div>
                        Identifiant :
                        <input type="text" size="20" placeholder="Insérer l'adresse email" name="identifiant" required autocomplete="off" /> <br> <br>

                        Mot de passe :
                        <input type="password" size="20" placeholder="Insérer le mot de passe" name="motdepasse" required />
                        <?php
                            if (isset($_SESSION['pb'])){
                                echo "cet identifiant n'existe pas ou le mot de passe est erroné";
                                unset($_SESSION["pb"]);
                            } 
                        ?>
                    </div>
                    <br>
                    <input type="submit" name="valider" value="Se connecter">
                </form>
            </article>
        
    </body>

    <footer>
        <a href="#hautdepage" style="margin-left: 20px;"> retourner en haut de la page </a> 
        <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
        <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
    </footer>
</html>