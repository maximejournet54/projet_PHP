<?php
    include "connection.php";
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajout d'un article</title>
    </head>
    <body>
        <center>
            <h1>Ajout d'un article</h1>
            <form method="POST" name="ajoutArticle"></form>
            <input type="radio" name="theme" placeholder="inserer le nom" value=""/>
            <br>
            <br>
            <input type="text" name="titre" placeholder="inserer le titre" value=""/>
            <br>
            <br>
            <input type="text" name="texte" placeholder="inserer le texte" value=""/>
            <br>
        </center>

    </body>
</html>

