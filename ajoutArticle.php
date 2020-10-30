<?php
    include "connection_bdd.php";
    error_reporting(E_ALL & ~E_NOTICE);
    $req='SELECT description from THEME';
    $result=$objPdo->prepare($req);
    $result->execute();
   
        if(isset($_POST['ajouter'])){
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
                $req2="INSERT INTO news(idnews,idtheme,titrenews,datenews,textenews,idredacteur) VALUES (:idnews,:idtheme,:titrenews,:datenews,:textenews,:idredacteur)";
                $insert=$objPdo->prepare($req2);

                $idnews=rand(6,100);//generation d'un nb aleatoire
                $date=date("y.m.d");//generation de la date du jour au format AAAA/MM/JJ comme dans la bdd
                //$idredacteur=
                $insert->execute(array('idnews'=>$idnews,':idtheme'=>$_POST['theme'],':titrenews'=>$_POST['titre'], 'datenews'=>$date,
                ':textenews'=>$_POST['texte'], ':idredacteur'=>$idredacteur));
            }

            try {
                $insert->execute();
                unset($insert);
            } catch (Exception $exception) {
                die($exception->getMessage());
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
        <center>
            <header>
                <nav>
                    <ul>
                        <li>
                            <a href="./accueil.html">
                                <div>Retour à l'accueil</div>
                            </a>
                            <div>Retour à l'accueil</div>
                        </a>
                        </li>
                    </ul>
                </nav>
            </header>
        
            <h1 style="color: white;">Ajout d'un article</h1>

            <form method="POST" name="ajoutArticle" style="color: violet;">
                <label for="theme">theme :</label>
                <input type="radio" name="theme" id="culture"  value="culture">
                <label for="culture">culture</label>
                <input type="radio" name="theme" id="enquête"  value="enquête">
                <label for="enquête">enquête</label> 
                <input type="radio" name="theme" id="environnement"  value="environnement">
                <label for="environnement">environnement</label>
                <br>
                <input type="radio" name="theme" id="fait_divers"  value="fait divers">
                <label for="fait_divers">fait divers</label>
                <input type="radio" name="theme" id="insolite"  value="insolite">
                <label for="insolite">insolite</label>
                <input type="radio" name="theme" id="international"  value="international">
                <label for="international">international</label>
                <br>
                <input type="radio" name="theme" id="monde"  value="monde">
                <label for="monde">monde</label>
                <input type="radio" name="theme" id="people"  value="people">
                <label for="people">people</label>
                <input type="radio" name="theme" id="politique"  value="politique">
                <label for="politique">politique</label>
                <input type="radio" name="theme" id="santé"  value="santé">
                <label for="santé">santé</label>
                <br>
                <input type="radio" name="theme" id="sciences"  value="sciences">
                <label for="sciences">sciences</label>
                <input type="radio" name="theme" id="société"  value="société">
                <label for="société">société</label>
                <input type="radio" name="theme"  id="sport" value="sport">
                <label for="sport">sport</label>
                <br>
                <br>
                <label for="titre">titre : </label><input type="text" name="titre" placeholder="insérer le titre" value="<?php echo $value['titre']?>" required>
                <br>
                <span class="erreur"><?php if (isset($erreur['titre'])) {
                    echo $erreur['titre'];
                } ?></span> 
                <br>
                <label for="texte">texte : </label> <textarea name="texte" placeholder="insérer le texte" maxlength=500 value="<?php echo $value['texte']?>" required></textarea>
                <br>
                <span class="erreur"><?php echo $erreur['texte']?></span> 
                <br>
                <input type="submit" name="valider" value="valider">
            </form>
        </center>

    </body>
</html>

            