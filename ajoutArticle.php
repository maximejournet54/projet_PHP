<?php
include ('connection_bdd.php');
$result = $objPdo->query('SELECT description FROM theme'); 
    if(isset($_POST['ajouter'])){
        $erreur=[];
        $value=[];
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
            
            $req="INSERT INTO news(idtheme,titrenews,textenews);
            VALUES (:idtheme,:titrenews:textenews)";
            $insert=$objPdo->prepare($req);
            $insert->execute(array(':idtheme'=>$_POST['theme'],':titrenews'=>$_POST['titre'],
            ':textenews'=>$_POST['texte']));

            
            

        }

        try {
            $insert->execute();
            unset($insert);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajout d'un article</title>
    </head>
    <body>
        <?php 
        var_dump($result[0]);
            exit();?>
        <center>
            <h1>Ajout d'un article</h1>
            <form method="POST" name="ajoutArticle"></form>
            <label for="theme">theme : </label><input type="radio" name="theme" placeholder="insérer le thème" 
            value="<?php
            foreach ($result as $row) {
                echo  '"'. $row['description'] ;
                var_dump($row['description']);
            }
            ?>">

            <br/>
            <br>
            <label for="titre">titre : </label><input type="text" name="titre" placeholder="insérer le titre" value="<?php echo $value['titre']?>"/>
            <br>
            <span class="erreur"><?php if (isset($erreur['titre'])) {
                echo $erreur['titre'];
            } ?></span> 
            <br>
            <label for="texte">texte : </label> <textarea name="texte" placeholder="insérer le texte" maxlength=500 value="<?php echo $value['texte']?>"></textarea>
            <br>
            <span class="erreur"><?php echo $erreur['texte']?></span> 
            <br>
            <input type="submit" name="valider" value="valider">
        </center>

    </body>
</html>

            