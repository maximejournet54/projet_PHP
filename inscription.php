<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include "connection_bdd.php";

    // gestion des erreurs
    if (isset($_POST['valider']))
    {
        $Terreur['nom']='à saisir';
        if (isset($_POST["nom"])){
            $nom=$_POST['nom'];
            if (!empty(trim($nom))){
                $Terreur['nom']='';
            }
        }
        $Terreur['prenom']='à saisir';
        if (isset($_POST["prenom"])){
            $prenom=$_POST['prenom'];
            if (!empty(trim($prenom))){
                $Terreur['prenom']='';
            }
        }
        $Terreur['email']='à saisir';
        if (isset($_POST["email"])){
            $mail=$_POST['email'];
            if (!empty(trim($mail))){
                $Terreur['email']='';
            }
        }
        $Terreur['motdepasse']='à saisir';
        if (isset($_POST["motdepasse"])){
            $motdepasse=$_POST['motdepasse'];
            if (!empty(trim($motdepasse))){
                $Terreur['motdepasse']='';
            }
        }
        
        //ajout du redacteur dans la bdd
        $req="INSERT INTO redacteur VALUES (NULL,:nomredac,:prenomredac,:mailredac,:mdpredac)";
        $insert=$objPdo->prepare($req);
        $insert->bindValue('nomredac',$_POST['nom'],PDO::PARAM_STR);
        $insert->bindValue('prenomredac',$_POST['prenom'],PDO::PARAM_STR);
        $insert->bindValue('mailredac',$_POST['prenom'],PDO::PARAM_STR);
        $insert->bindValue('mdpredac',$_POST['prenom'],PDO::PARAM_STR);
        $insert->execute();   
    }
?>

<!DOCTYPE html>
<script type="text/javascript" src="verif_mdp.js"></script> <!-- faire le fichier de vérif -->

<html>
    <head>
        <title>Inscription sur le site</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <header>
        <nav>
            <ul id="navigation">
                <li><a href="./connection_redacteur.php">Connexion</a></li>
                <li><a href="./accueil.php">Retour à l'accueil</a></li>
            </ul>
        </nav>
    </header>

    <body id="hautdepage" class="texte">
        <h1 class="titre">Inscription</h1>
        <form method="POST" action="accueil_redacteur.php"> <br> <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
            <p><label for="nom">Nom : <br> </label></p>
            <input type="text" size="60" placeholder="saisir le nom" name="nom" required autocomplete="off" > <br> 
            <p><span style='color:red'><?php echo $Terreur['nom'];?></span></p>
            <br>
            <p><label for="prenom"><br>Prénom: <br></label></p>
            <input type="text" size="50" placeholder="saisir le prenom" name="prenom" required autocomplete="off" > <br> <br>
            <p><span style='color:red'><?php echo $Terreur['prenom'];?></span></p>
            <p><label for="adressemail"><br>Email:<br></label></p>
            <input type="text" size="50" placeholder="saisir l'adresse email" name="email" required autocomplete="off" > </br> </br>           
            <p><span style='color:red'><?php echo $Terreur['email'];?></span> </p>                                                                      
            <p><label for="motdepasse"><br>Mot de passe:<br></label></p>
            <input type="password" size="30" placeholder="saisir le mot de passe" name="motdepasse" required > </br> </br>
            <p><label for="verifmotdepasse"><br>Vérification du mot de passe :<br></label> </p>
            <br>
            <input id="mdp2" type="password" oninput="check_mdp()" size="30" placeholder="resaisir le mot de passe" name="mdp" required > </br> </br>
            <p><span style='color:red'><?php echo $Terreur['motdepasse'];?></span></p>
            <p id="label_mdp"></p>
            <br>
            <input type="submit" onclick="javascript: return check_mdp_valide();" name="valider" value="inscription" >
        </form>
    </body>

    <footer>
        <a href="#hautdepage"> retourner en haut de la page </a> 
        <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
        <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
    </footer>
</html>