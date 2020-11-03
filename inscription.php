<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include "connection_bdd.php";

    //+ gestion des erreurs
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
        $insert->bindValue('mailredac',$_POST['email'],PDO::PARAM_STR);
        $insert->bindValue('mdpredac',$_POST['motdepasse'],PDO::PARAM_STR);
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

    <body>
        <center>
            <header>
                <nav>
                    <ul>
                        <li><a href="./connection_redacteur.php">
                                <div>Connexion</div>
                            </a></li>
                        <li><a href="./accueil.php">
                                <div>Retour à l'accueil</div>
                            </a></li>
                    </ul>
                </nav>
            </header>
            <article>
                <h1>Inscription</h1>
                <form method="POST" action=""> <br> <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
                    <label for="nom">Nom : <br> </label>
                    <input type="text" size="60" placeholder="saisir le nom" name="nom" <?php
                                                                                            if (isset($_SESSION['nom'])) {
                                                                                                echo 'value=" ' . $_SESSION['nom'] . '"';
                                                                                                unset($_SESSION['nom']);
                                                                                            }
                                                                                        ?> required autocomplete="off" > <br> 
                    <span style='color:red'><?php echo $Terreur['nom'];?></span>
                    <br>
                    <label for="prenom"><br>Prénom: <br></label>
                    <input type="text" size="50" placeholder="saisir le prenom" name="prenom" required <?php
                                                                                                    if (isset($_SESSION['prenom'])) echo 'value="' . $_SESSION['prenom'] . '"'
                                                                                                    ?> autocomplete="off" > <br> <br>
                    <span style='color:red'><?php echo $Terreur['prenom'];?></span>
                    <label for="adressemail"><br>Email:<br></label>
                    <input type="text" size="50" placeholder="saisir l'adresse email" name="email" <?php
                                                                                    if (isset($_SESSION['mail'])) echo 'value="' . $_SESSION['mail'] . '"';
                                                                                    unset($_SESSION['mail']);
                                                                                    ?> required autocomplete="off" > </br> </br>
                        <?php if (isset($_SESSION['pb']) && ($_SESSION['pb'] == 1 || $_SESSION['pb'] == 3)) echo "ce mail existe déjà</br>"; ?>
                    <span style='color:red'><?php echo $Terreur['email'];?></span>                                                                       
                    <label for="motdepasse"><br>Mot de passe:<br></label>
                    <input type="password" size="30" placeholder="saisir le mot de passe" name="motdepasse" <?php
                                                                                                    if (isset($_SESSION['mdp'])) echo 'value="' . $_SESSION['mdp'] . '"';
                                                                                                    unset($_SESSION['mdp']);
                                                                                                    ?> required > </br> </br>
                    <label for="verifmotdepasse"><br>Vérification du mot de passe :<br></label> 
                    <br>
                    <input id="mdp2" type="password" oninput="check_mdp()" size="30" placeholder="resaisir le mot de passe" name="mdp" <?php
                                                                                                                                            if (isset($_SESSION['mdp'])) {
                                                                                                                                                echo 'value="' . $_SESSION['mdp'] . '"';
                                                                                                                                                unset($_SESSION['mdp']);
                                                                                                                                            }
                                                                                                                                        ?> required > </br> </br>
                    <span style='color:red'><?php echo $Terreur['motdepasse'];?></span>
                    <p id="label_mdp"></p>
                        <?php if (isset($_SESSION['pb']) && ($_SESSION['pb'] == 1 || $_SESSION['pb'] == 2)) echo "ce pseudo existe déjà</br>"; ?>
                        <?php unset($_SESSION['pb']); ?> 
                        </br>
                    <input type="submit" onclick="javascript: return check_mdp_valide();" name="valider" value="inscription" >
                </form>
            </article>
        </center>
    </body>
</html>