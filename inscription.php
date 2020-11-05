<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include "connection_bdd.php";

    // gestion des erreurs
    if (isset($_POST['valider']))
    {
        $Terreur=[];
        $Terreur['nom']='La saisie du nom est obligatoire';
        if (isset($_POST["nom"])){
            $nom=$_POST['nom'];
            if (!empty(trim($nom))){
                $Terreur['nom']='';
            }
        }
        $Terreur['prenom']='La saisie du prénom est obligatoire';
        if (isset($_POST["prenom"])){
            $prenom=$_POST['prenom'];
            if (!empty(trim($prenom))){
                $Terreur['prenom']='';
            }
        }
        //erreurs de l'email
        $Terreur['email']='La saisie de l\'adresse email est obligatoire';
        $Terreur['email2']="Cette adresse email existe déjà, veuillez vous connecter ou choisir une autre adresse email";
        $Terreur['email3']='Saisir une adresse email valide';

        if (isset($_POST["email"])){
            $mail=$_POST['email'];
            //verification que le champ d'email n'est pas vide
            if (!empty(trim($mail))){
                $Terreur['email']='';
            }
            //vérification que l'adresse email n'existe pas dans la bdd
            $req1="SELECT adressemail FROM redacteur";
            $insert1=$objPdo->prepare($req1);
            $insert1->execute(); 
            foreach ($insert1 as $row) {
                if($mail!=$row['adressemail']){
                    $Terreur['email2']='';
                }
            }
            //verification que l'adresse email rentrée est bien une adresse email
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $Terreur['email3']='';
            }
        }
        $Terreur['motdepasse']='à saisir';
        if (isset($_POST["motdepasse"])){
            $motdepasse=$_POST['motdepasse'];
            if (!empty(trim($motdepasse))){
                $Terreur['motdepasse']='';
            }
        }
        //ajout du redacteur dans la bdd si l'adresse email est valide
        if(empty(trim($Terreur['email'].$Terreur['email2'].$Terreur['email3']))){
            //($Terreur['email']='') && ($Terreur['email2']='') && ($Terreur['email3']='')
            $req="INSERT INTO redacteur VALUES (NULL,:nomredac,:prenomredac,:mailredac,:mdpredac)";
            $insert=$objPdo->prepare($req);
            $insert->bindValue('nomredac',$nom,PDO::PARAM_STR);
            $insert->bindValue('prenomredac',$prenom,PDO::PARAM_STR);
            $insert->bindValue('mailredac',$mail,PDO::PARAM_STR);
            $insert->bindValue('mdpredac',$motdepasse,PDO::PARAM_STR);
            $insert->execute();  
            header("location: accueil_redacteur.php");
        }
                    
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
        
        <form method="POST" > <br> <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
            <p><label for="nom">Nom : <br> </label></p>
            <input class="champ" type="text" size="60" placeholder="saisir le nom" name="nom" required autocomplete="off" > <br> 
            <p><span style='color:red'><?php echo $Terreur['nom'];?></span></p>
            <br>
            <p><label for="prenom"><br>Prénom: <br></label></p>
            <input class="champ" type="text" size="50" placeholder="saisir le prenom" name="prenom" required autocomplete="off" > <br> <br>
            <p><span style='color:red'><?php echo $Terreur['prenom'];?></span></p>
            <p><label for="adressemail"><br>Email:<br></label></p>
            <input class="champ" type="text" size="50" placeholder="saisir l'adresse email" name="email"  > </br> </br>           
            <p><span style='color:red'><?php echo $Terreur['email'].$Terreur['email2'].$Terreur['email3'];?></span> </p>                                                                      
            <p><label for="motdepasse"><br>Mot de passe:<br></label></p>
            <input class="champ" type="password" size="30" placeholder="saisir le mot de passe" name="motdepasse" required > </br> </br>
            <p><label for="verifmotdepasse"><br>Vérification du mot de passe :<br></label> </p>
            <br>
            <input class="champ" id="mdp2" type="password" oninput="check_mdp()" size="30" placeholder="resaisir le mot de passe" name="mdp" required > </br> </br>
            <p><span style='color:red'><?php echo $Terreur['motdepasse'];?></span></p>
            <p id="label_mdp"></p>
            <br>
            <input type="submit" name="valider" value="inscription" >
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