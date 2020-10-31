<?php
    include "connection_bdd.php";
    error_reporting(E_ALL & ~E_NOTICE);
    $result = $objPdo->query('SELECT description FROM theme ORDER BY description ASC');
   
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
                $date=date("y/m/d/h/i/s");//generation de la date du jour au format AAAA/MM/JJ/h/m/s  comme dans la bdd
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
        <center> <!-- balises center a enlever et utiliser css-->
            <header>
                <nav>
                    <ul>
                        <li>
                            <a href="./accueil.html">
                                <div>Retour à l'accueil</div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
        
            <h1 style="color: white;">Ajout d'un article</h1>
            <form method="POST" name="ajoutArticle" style="color: violet;">
                <label for="theme">theme :</label>
                <input type="text" list=theme>
                <datalist id=theme>
                    <?php
                        foreach ($result as $value) {
                            echo "<option>".$value['description'];
                        }
                    ?>
                </datalist>
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

            