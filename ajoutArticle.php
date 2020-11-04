<?php
    session_start();
    include "connection_bdd.php";
    error_reporting(E_ALL & ~E_NOTICE);
    $req='SELECT idtheme, description FROM theme ORDER BY idtheme ASC';
    $result=$objPdo->prepare($req);
    $result->execute();
   
    if(isset($_POST['valider'])){
        $erreur=[];
        $value=[];
        if (!isset($_POST['theme'])) {
            $erreur['theme']='selection obligatoire du theme';
        }
        else
        {
            $value['theme']=$_POST['theme'];
        }
        if (!isset($_POST['titre']) or strlen(trim($_POST['titre']))==0) {
            $erreur['titre']='saisie obligatoire du titre';
        }
        else {
            $value['titre']=trim($_POST['titre']);
        }
        if (!isset($_POST['texte']) or strlen(trim($_POST['texte']))==0) {
            $erreur['texte']='saisie obligatoire du texte de l\'article';
        }
        else {
            $value['texte']=trim($_POST['texte']);
        }

        if (count($erreur)==0) {
            //requetes
            $idredacteur=$_SESSION['idredacteur'];
            date_default_timezone_set('Europe/Paris');
            $now=time();//generation de la date du jour au format JJ/MM/AAAA h/m/s
            //$idredacteur=rand(1,intval($insert2));
            $string=$_POST['theme'];

            //creation d'un article
            $req="INSERT INTO news(idnews,idtheme,titrenews,datenews,textenews,idredacteur) VALUES (:idnews,:idtheme,:titrenews,:datenews,:textenews,:idredacteur)";
            $insert=$objPdo->prepare($req);
            $insert->bindValue('idnews',NULL,PDO::PARAM_INT);
            $insert->bindValue('idtheme',intval($string[0].$string[1]),PDO::PARAM_INT);
            $insert->bindValue('titrenews',$_POST['titre'],PDO::PARAM_STR);
            $insert->bindValue('datenews',date("Y-m-d H:i:s",$now),PDO::PARAM_STR);
            $insert->bindValue('textenews',$_POST['texte'],PDO::PARAM_STR);
            $insert->bindValue('idredacteur',$idredacteur,PDO::PARAM_INT);
            $insert->execute();
        }     
         
    }

    if (isset($_POST['annuler'])) {
        header("location: accueil_redacteur.php");
    }
?>

<html>
    <html lang="fr">
    <head>
        <title>Ajout d'un article</title>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="accueil.css">
    </head>

    <header>
            <nav>
                <ul id="navigation">
                    <li><a href="Accueil.php" title="Retour à l'accueil">Accueil</a></li>
                    <li><a href="traitement_deconnexion.php" title="Se déconnecter">Déconnection</a></li>
                </ul>
            </nav>
    </header>

    <body id="hautdepage" class="texte">
        <h1 class="titre">Ajout d'un article</h1>
        <form method="POST" name="ajoutArticle">
            <label for="theme">theme :</label>
            <select name="theme"> 
                <?php
                    foreach ($result as $value) {
                        echo "<option>".$value['idtheme']." ".$value['description'];
                    }
                ?>
            </select>
            <br>
            <span class="erreur"><?php echo $erreur['theme'];?></span> 
            <br>
            <label for="titre">titre : </label><input type="text" name="titre" placeholder="saisir le titre" value="<?php echo $value['titre']?>">
            <br>
            <span class="erreur"><?php echo $erreur['titre'];?></span> 
            <br>
            <label for="texte">texte : </label> 
            <textarea id="text" name="texte" placeholder="saisir le texte" value="<?php echo $value['texte']?>"></textarea>
            <br>
            <span class="erreur"><?php echo $erreur['texte']?></span> 
            <br>  
            <input type="submit" name="annuler" value="Annuler" style="font-size: 25; color:violet;" action="Accueil.php">
            <br>   
            <br>  
            <input type="submit" name="valider" value="Valider" style="font-size: 25; color:violet;">
        </form>
    </body>

    <footer>
        <a href="#hautdepage"> retourner en haut de la page </a> 
        <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
        <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
    </footer>
</html>

            