<?php
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
            include "connection_bdd.php";
            //requetes
            $req="INSERT INTO news(idnews,idtheme,titrenews,datenews,textenews,idredacteur) VALUES (:idnews,:idtheme,:titrenews,:datenews,:textenews,:idredacteur)";
            $insert=$objPdo->prepare($req);
            $req2="SELECT COUNT(idredacteur) FROM redacteur,news WHERE redacteur.idredacteur=news.idredacteur";
            $insert2=$objPdo->prepare($req2);

            //creation d'un article
            $date=date("d/m/Y h:i:s");//generation de la date du jour au format JJ/MM/AAAA h/m/s
            $idredacteur=rand(1,intval($insert2));
            $string=$_POST['theme'];

            $insert->execute(array(':idnews'=>NULL,':idtheme'=>intval($string[0]).intval($string[1]),':titrenews'=>$_POST['titre'], ':datenews'=>$date,
            ':textenews'=>$_POST['texte'],':idredacteur'=>$idredacteur));

        }     
         
    }
?>

<html style="background-color: #222222;">
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajout d'un article</title>
    </head>
    <body>
        <center> <!-- balises center a enlever et utiliser css-->
            <header>
                <nav>
                    <ul>
                        <li>
                            <a href="./accueil.php">
                                <div>Retour à l'accueil</div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
        
            <h1 style="color: white;font-size: 35">Ajout d'un article</h1>
            <form method="POST" name="ajoutArticle" style="color: violet; font-size: 30">
                <label for="theme">theme :</label>
                <input type="text" list=theme name="theme" placeholder="choisir un thème" >
                <datalist id=theme>
                    <?php
                        foreach ($result as $value) {
                            echo "<option>".$value['idtheme']." ".$value['description'];
                        }
                    ?>
                </datalist>
                <br>
                <span class="erreur"><?php echo $erreur['theme'];?></span> 
                <br>
                <br>
                <label for="titre">titre : </label><input type="text" name="titre" placeholder="insérer le titre" value="<?php echo $value['titre']?>">
                <br>
                <span class="erreur"><?php echo $erreur['titre'];?></span> 
                <br>
                <label for="texte">texte : </label> 
                <textarea id="text" name="texte" placeholder="insérer le texte" value="<?php echo $value['texte']?>"></textarea>
                <br>
                <span class="erreur"><?php echo $erreur['texte']?></span> 
                <br>       
                <input type="submit" name="valider" value="valider" style="font-size: 25; color:violet;">
            </form>
        </center>

    </body>
</html>

            