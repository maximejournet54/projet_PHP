<?php
session_start();
include "connection_bdd.php";
if(isset($_POST['suppression'])){
    $idredacteur=$_SESSION['idredacteur'];
     $req = "DELETE FROM redacteur WHERE idredacteur =$idredacteur";
     $result=$objPdo->prepare($req);
     $result->execute();
     header('Location: accueil.php');
     $_SESSION['success'] = "Le compte à été supprimé";
     exit;
 }
 if (isset($_POST['retour']))
    {
        header("location: accueil_redacteur.php");
    }
 ?>

<html>
    <head>
        <title>Suppression compte</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <body id="hautdepage" class="texte">
    <h1 class="titre">Etes vous certain de vouloir supprimer ce compte ?</h1>
    <br>
    <form method="POST" >
        <input type='submit' name='suppression' value='suppression'></input>
        <input type='submit' name='retour' value='retour'></input>
    </form>
    </body>

    <footer>
        <a href="#hautdepage" style="margin-left: 20px;"> retourner en haut de la page </a> 
        <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
        <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
    </footer>
</html>