<!-- page de connection d'un rédacteur au site pour pouvoir créer et intéragir avec les fonctionnalitées du site -->
<?php
    session_start();
    include "connection_bdd.php";
    error_reporting(E_ALL & ~E_NOTICE);

    if(isset($_POST['valider'])){
        $erreur=[];
        if (!isset($_POST['identifiant'])) {
            $erreur['identifiant']='selection obligatoire de l\'identifiant';
        }
        if (!isset($_POST['motdepasse'])) {
            $erreur['motdepasse']='selection obligatoire du mot de passe';
        }
        if(isset($_POST['identifiant'])&& isset($_POST['motdepasse'])){
            $bSoumis=1;
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
    }
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
        <h1 class="titre">Connexion</h1>
        <form method="POST" >  <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
            <label for="Identifiant">Identifiant : </label>
            <input class="champ" type="text" size="20" placeholder="Insérer l'adresse email" name="identifiant" required > <br> <br>
            <br>
            <span class="erreur"><?php echo $erreur['identifiant'];?></span> 
            <label for="motdepasse">Mot de passe : </label>  
            <input class="champ" type="password" size="20" placeholder="Insérer le mot de passe" name="motdepasse" required >
            <br>
            <span class="erreur"><?php echo $erreur['motdepasse'];?></span> 
            <br>
            <input type="submit" name="valider" value="Se connecter">
        </form>     
    </body>

    <footer>
        <nav>
            <ul id="navigation">
                    <li><a href="#hautdepage"> retourner en haut de la page </a> </li>
                    <li><a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a></li>
                    <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>        
            </ul>
        </nav>
    </footer>
</html>